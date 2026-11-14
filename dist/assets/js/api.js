/* WebAcademy — client API minimaliste vers index.php?api=… */
window.WA = window.WA || {};

WA.api = (function () {
    let bootCache = null;

    function url(endpoint, params) {
        const qs = new URLSearchParams(Object.assign({ api: endpoint }, params || {}));
        return 'index.php?' + qs.toString();
    }

    async function request(endpoint, options, params) {
        const controller = typeof AbortController === 'function' ? new AbortController() : null;
        const timer = controller ? setTimeout(() => controller.abort(), 30000) : null;
        try {
            const res = await fetch(url(endpoint, params), Object.assign({
                credentials: 'same-origin',
                headers: { 'Accept': 'application/json' }
            }, options || {}, controller ? { signal: controller.signal } : {}));

            const raw = await res.text();
            let data = null;
            try { data = raw ? JSON.parse(raw) : {}; } catch (err) { data = null; }

            if (!res.ok || !data || data.ok === false) {
                const message = (data && (data.error || data.message)) || ('Requête échouée (' + res.status + ').');
                const error = new Error(message);
                error.status = res.status;
                error.payload = data;
                throw error;
            }
            return data;
        } catch (err) {
            if (err && err.name === 'AbortError') {
                throw new Error('Le serveur met trop de temps à répondre. Réessayez.');
            }
            throw err;
        } finally {
            if (timer) clearTimeout(timer);
        }
    }

    function get(endpoint, params) {
        return request(endpoint, { method: 'GET' }, params);
    }

    function post(endpoint, payload) {
        return request(endpoint, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(payload || {})
        });
    }

    /** Bootstrap complet (manifest, disponibilité, progression, réglages). */
    function bootstrap(force) {
        if (!force && bootCache) return Promise.resolve(bootCache);
        return get('bootstrap').then(data => {
            bootCache = data;
            return data;
        });
    }

    function invalidate() {
        bootCache = null;
    }

    return { get, post, bootstrap, invalidate, url };
})();
