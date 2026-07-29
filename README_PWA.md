# PWA Notes for AmikomEventHub

What I added:
- `public/manifest.json` (updated to reference `public/icons/*.{png,svg}`)
- `public/service-worker.js` (caches root, manifest, offline page, icons, css/js)
- `public/offline.html` (offline fallback page)
- `public/icons/icon-192.svg`, `icon-512.svg` and PNG fallbacks `icon-192.png`, `icon-512.png`
- `resources/views/Layouts/app.blade.php` updated:
  - `apple-touch-icon` points to `icons/icon-192.svg`
  - service worker registration
  - install prompt UI and permanent install button

How to test locally:
1. Run Laravel server:

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

2. Open `http://127.0.0.1:8000` in Chrome.
3. Open DevTools -> Application -> Manifest: verify icons and start_url.
4. DevTools -> Application -> Service Workers: verify `service-worker.js` registered.
5. Turn off network in DevTools, reload page -> should show `offline.html` for navigation requests.

Notes & next steps:
- Replace placeholder icons with branded PNGs (192x192 and 512x512) for best compatibility.
- Verify `Service-Worker-Allowed` header when deploying under a subpath.
- Consider precaching more images and API fallback strategies.
- Manual QA steps below.

Manual QA steps:
1. Start server:

```bash
php artisan serve --host=127.0.0.1 --port=8000
```
2. Open `http://127.0.0.1:8000` in Chrome.
3. Open DevTools -> Application -> Manifest: verify the PNG icons appear and sizes.
4. DevTools -> Application -> Service Workers: ensure `service-worker.js` is registered and activated.
5. In Application -> Service Workers, check "Update on reload", then reload and inspect Cache Storage -> `amikom-eventhub-v1` to confirm `icon-192.png` and `icon-512.png` are cached.
6. Simulate offline (Network -> Offline), reload main route — navigation should fall back to `offline.html`.
7. Trigger install prompt: open DevTools -> Application -> Manifest -> check "Add to home screen" eligibility or wait for `beforeinstallprompt` and click the permanent `Pasang` button.
