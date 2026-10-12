// Captures phpMyAdmin avec Edge sans interface, piloté par le protocole DevTools.
// Usage : node pma.mjs <dossier du projet> <shots.json>
// shots.json : [{ "url": "index.php?route=...", "out": "C:/.../x.png", "height": 765 }]
import { spawn, spawnSync } from 'node:child_process';
import { readFileSync, writeFileSync } from 'node:fs';
import path from 'node:path';

const [projectDir, shotsFile] = process.argv.slice(2);
const EDGE = 'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe';
const PORT = 9333;

const env = Object.fromEntries(
    readFileSync(path.join(projectDir, '.env'), 'utf8')
        .split(/\r?\n/)
        .filter((l) => /^[A-Z_]+=/.test(l))
        .map((l) => [l.slice(0, l.indexOf('=')), l.slice(l.indexOf('=') + 1).replace(/^"|"$/g, '')])
);
const base = `http://${env.DB_HOST}/phpmyadmin/`;
const shots = JSON.parse(readFileSync(shotsFile, 'utf8'));
const sleep = (ms) => new Promise((r) => setTimeout(r, ms));

const edge = spawn(EDGE, [
    '--headless=new', '--disable-gpu', '--hide-scrollbars', '--lang=fr-FR',
    `--remote-debugging-port=${PORT}`,
    `--user-data-dir=${path.join(path.dirname(shotsFile), 'edge-pma-profile')}`,
    '--window-size=1440,765', 'about:blank',
], { stdio: 'ignore' });

try {
    let target;
    for (let i = 0; i < 40 && !target; i++) {
        await sleep(250);
        try {
            const list = await (await fetch(`http://127.0.0.1:${PORT}/json`)).json();
            target = list.find((t) => t.type === 'page');
        } catch {}
    }
    if (!target) throw new Error('Edge ne répond pas');

    const ws = new WebSocket(target.webSocketDebuggerUrl);
    await new Promise((res, rej) => { ws.onopen = res; ws.onerror = rej; });
    let id = 0;
    const pending = new Map();
    ws.onmessage = (m) => {
        const msg = JSON.parse(m.data);
        if (msg.method === 'Page.javascriptDialogOpening') {
            console.log('dialogue', msg.params.type, msg.params.message);
            ws.send(JSON.stringify({ id: ++id, method: 'Page.handleJavaScriptDialog', params: { accept: true } }));
        }
        if (msg.id && pending.has(msg.id)) {
            pending.get(msg.id)(msg);
            pending.delete(msg.id);
        }
    };
    const send = (method, params = {}) => new Promise((res) => {
        pending.set(++id, res);
        ws.send(JSON.stringify({ id, method, params }));
    });
    const evaluate = async (expression) =>
        (await send('Runtime.evaluate', { expression, returnByValue: true, awaitPromise: true })).result?.result?.value;
    const goto = async (url) => {
        await send('Page.navigate', { url });
        for (let i = 0; i < 60; i++) {
            await sleep(250);
            if ((await evaluate('document.readyState')) === 'complete') break;
        }
        await sleep(1200);
    };

    await send('Page.enable');
    await send('Runtime.enable');
    await goto(base);

    if (await evaluate('!!document.querySelector("#input_username")')) {
        await evaluate(`(() => {
            document.querySelector('#input_username').value = ${JSON.stringify(env.DB_USERNAME)};
            document.querySelector('#input_password').value = ${JSON.stringify(env.DB_PASSWORD)};
            document.querySelector('#input_go').click();
        })()`);
        await sleep(3000);
    }

    const info = await evaluate(`JSON.stringify({
        title: document.title,
        logged: !document.querySelector('#input_username'),
        version: (document.body.innerText.match(/Version[^\\n]*?(\\d+\\.\\d+\\.\\d+)/) || [])[1] || null,
        url: location.pathname
    })`);
    console.log('session', info);

    for (const shot of shots) {
        await send('Emulation.setDeviceMetricsOverride', {
            width: shot.width || 1440, height: shot.height || 765, deviceScaleFactor: 1, mobile: false,
        });
        await goto(base + shot.url.replace('{db}', env.DB_DATABASE));
        if (shot.js) {
            for (const step of [].concat(shot.js)) {
                const r = await send('Runtime.evaluate', { expression: step, returnByValue: true });
                console.log('js', JSON.stringify(r.result?.exceptionDetails?.exception?.description ?? r.result?.result?.value ?? r));
                await sleep(4000);
            }
        }
        const png = await send('Page.captureScreenshot', { format: 'png' });
        writeFileSync(shot.out, Buffer.from(png.result.data, 'base64'));
        console.log('capture', path.basename(shot.out), await evaluate('document.title'));
    }
    ws.close();
} finally {
    // Edge lance des processus enfants : tuer tout l'arbre, sinon le profil et le port restent pris.
    spawnSync('taskkill', ['/PID', String(edge.pid), '/T', '/F'], { stdio: 'ignore' });
}
process.exit(0);
