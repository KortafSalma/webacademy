/* WebAcademy — client API minimaliste vers index.php?api=… avec persistance de session */
window.WA = window.WA || {};

WA.api = (function () {
    let bootCache = null;
    const TOKEN_KEY = 'wa_auth_token';

    function getToken() {
        try {
            return localStorage.getItem(TOKEN_KEY) || null;
        } catch (e) {
            return null;
        }
    }

    function setToken(token) {
        try {
            if (token) {
                localStorage.setItem(TOKEN_KEY, token);
            } else {
                localStorage.removeItem(TOKEN_KEY);
            }
        } catch (e) {}
    }

    function clearToken() {
        setToken(null);
    }

    function url(endpoint, params) {
        const queryObj = Object.assign({ api: endpoint }, params || {});
        const token = getToken();
        if (token && !queryObj.token) {
            queryObj.token = token;
        }
        const qs = new URLSearchParams(queryObj);
        return 'index.php?' + qs.toString();
    }

    async function request(endpoint, options, params) {
        const controller = typeof AbortController === 'function' ? new AbortController() : null;
        const timer = controller ? setTimeout(() => controller.abort(), 30000) : null;
        try {
            const token = getToken();
            const headers = Object.assign({
                'Accept': 'application/json'
            }, (options && options.headers) || {});

            if (token) {
                headers['X-Auth-Token'] = token;
            }

            const res = await fetch(url(endpoint, params), Object.assign({
                credentials: 'same-origin',
                headers: headers
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
        const p = Object.assign({}, payload || {});
        const token = getToken();
        if (token && !p.token) {
            p.token = token;
        }
        return request(endpoint, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(p)
        });
    }

    /** Bootstrap complet (manifest, disponibilité, progression, réglages, user). */
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

    async function login(identifier, password) {
        const res = await post('auth-login', { identifier, password });
        if (res && res.token) {
            setToken(res.token);
            invalidate();
        }
        return res;
    }

    async function register(username, password, email, avatar) {
        const res = await post('auth-register', { username, password, email, avatar });
        if (res && res.token) {
            setToken(res.token);
            invalidate();
        }
        return res;
    }

    async function guest() {
        const res = await post('auth-guest', {});
        if (res && res.token) {
            setToken(res.token);
            invalidate();
        }
        return res;
    }

    async function logout() {
        try {
            await post('auth-logout', {});
        } catch (e) {}
        clearToken();
        invalidate();
    }

    async function me() {
        return get('auth-me');
    }

    async function setAvatar(avatar) {
        const res = await post('auth-avatar', { avatar });
        invalidate();
        return res;
    }

    return {
        get,
        post,
        bootstrap,
        invalidate,
        url,
        getToken,
        setToken,
        clearToken,
        login,
        register,
        guest,
        logout,
        me,
        setAvatar
    };
})();
