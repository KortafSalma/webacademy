const fs = require('node:fs');
const vm = require('node:vm');
const assert = require('node:assert/strict');
const source = fs.readFileSync('public/assets/js/runner.js', 'utf8').replace('return { run };', 'return { run, HARNESS };');
function setup() {
  let listener, frame;
  const ctx = {WA: {}, Math, Promise, setTimeout, clearTimeout,
    window: {addEventListener(_, fn) {listener = fn;}, removeEventListener() {}},
    document: {createElement() {return frame = {style: {}, setAttribute() {}, contentWindow: {postMessage() {}}};}, body: {appendChild() {}}}};
  vm.runInNewContext(source, ctx);
  return {run: ctx.WA.runner.run, harness: ctx.WA.runner.HARNESS,
    send(type, payload = {}, spoof = false) {listener({source: spoof ? {} : frame.contentWindow, data: {__waRunner: frame.srcdoc.match(/var TOKEN = "([^"]+)"/)[1], type, ...payload}});}};
}
(async () => {
  const a = setup();
  let script;
  const handlers = {};
  const child = {console, parent: {postMessage() {}}, setTimeout() {}, document: {createElement() {return {};}, body: {appendChild(el) {script = el.textContent;}}}, addEventListener(type, fn) {handlers[type] = fn;}};
  child.window = child;
  vm.runInNewContext(a.harness, child);
  handlers.message({data: {__waRunner: '__TOKEN__', cmd: 'run', code: 'console.log(42)', testCode: '', settle: 60}});
  new vm.Script(script);
  const pending = a.run({tests: [{type: 'js_async_expr', value: 'true'}], timeout: 800});
  let completed = false;
  pending.then(() => completed = true);
  a.send('done');
  a.send('results', {results: [{index: 0, ok: true}]}, true);
  a.send('results', {results: []});
  await new Promise(r => setTimeout(r, 120));
  assert.equal(completed, false, 'pending tests or spoofed messages must not finish');
  a.send('results', {results: [{index: 0, ok: true}]});
  assert.equal((await pending).ok, true);
  const b = setup();
  const timed = b.run({tests: [{type: 'js_expr', value: 'false'}], timeout: 800});
  b.send('done');
  assert.equal((await timed).timedOut, true);
  const c = setup();
  const empty = c.run({code: 'await Promise.resolve()'});
  c.send('done');
  c.send('results', {results: []});
  assert.equal((await empty).ok, true);
  console.log('Runner: generated script, async completion, missing results, source validation and timeout PASS');
})().catch(e => {console.error(e); process.exitCode = 1;});
const quizSource = fs.readFileSync('public/assets/js/quiz.js', 'utf8');
const kinds = {};
for (const name of ['questionKind', 'optionsFor']) {
  const fn = quizSource.match(new RegExp('function ' + name + '\\(q\\) \\{[\\s\\S]*?\\n\\s*\\}'));
  assert.ok(fn, name);
  kinds[name] = vm.runInNewContext('(' + fn[0] + ')');
}
assert.equal(kinds.questionKind({type: 'true_false'}), 'tf');
assert.equal(kinds.optionsFor({type: 'true_false'})[1], 'Vrai');
assert.equal(kinds.optionsFor({type: 'tf'})[1], 'Faux');
console.log('Quiz: both true/false conventions PASS');
