<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmikomEventHub - Temukan Event Seru!</title>

    <link rel="manifest" href="/manifest.json">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/icons/icon-192.svg">
    <meta name="theme-color" content="#4f46e5">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">

    <!-- Navigation -->
    <nav class="glass sticky top-8 z-40 mx-4 mt-4 px-6 py-4 rounded-2xl border border-white/20 shadow-lg flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">
                AH
            </div>
            <span class="text-xl font-bold tracking-tight">AmikomEventHub</span>
        </div>
        <div class="hidden md:flex gap-8 font-medium">
            <a href="#" class="text-indigo-600">Jelajahi</a>
            <a href="#" class="hover:text-indigo-600 transition">Kategori</a>
            <a href="#" class="hover:text-indigo-600 transition">Tentang Kami</a>
        </div>
    </nav>

    <!-- KONTEN DINAMIS -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-indigo-900 text-indigo-100 py-20 px-6 mt-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="space-y-4 col-span-2">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-900 font-bold text-xl">
                        AH
                    </div>
                    <span class="text-2xl font-bold text-white">AmikomEventHub</span>
                </div>
                <p class="max-w-xs text-indigo-300">
                    Platform reservasi tiket event online terbaik.
                </p>
            </div>
        </div>
    </footer>

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('/service-worker.js')
                    .then(function (registration) {
                        console.log('Service Worker registered with scope:', registration.scope);
                    })
                    .catch(function (error) {
                        console.warn('Service Worker registration failed:', error);
                    });
            });
        }
    </script>
    <script>
        // Permanent install button (visible on desktop/mobile when supported)
        function renderInstallButton() {
            const btn = document.createElement('button');
            btn.id = 'pwaInstallPermanent';
            btn.className = 'fixed bottom-6 right-6 z-50 px-4 py-3 bg-indigo-600 text-white rounded-full shadow-lg flex items-center gap-2';
            btn.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v12"></path><path d="M7 7l5-5 5 5"></path><path d="M21 21H3"></path></svg><span>Pasang</span>`;
            btn.style.display = 'none';
            document.body.appendChild(btn);
            return btn;
        }

        let deferredPrompt;
        const permanentBtn = renderInstallButton();

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            permanentBtn.style.display = 'flex';
        });

        permanentBtn.addEventListener('click', async () => {
            if (!deferredPrompt) return;
            deferredPrompt.prompt();
            const choice = await deferredPrompt.userChoice;
            console.log('User install choice', choice.outcome);
            deferredPrompt = null;
            permanentBtn.style.display = 'none';
        });

        window.addEventListener('appinstalled', () => {
            permanentBtn.style.display = 'none';
            console.log('PWA installed');
        });
    </script>
    <script>
        // PWA install prompt handling
        let deferredPrompt;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            const installBanner = document.createElement('div');
            installBanner.className = 'fixed bottom-6 left-6 right-6 max-w-xl mx-auto bg-white border rounded-lg shadow-lg p-4 flex items-center justify-between';
            installBanner.innerHTML = `<div class="flex items-center gap-3"><img src="/icons/icon-192.svg" width="48" height="48" alt="icon"><div><strong>Pasang AmikomEventHub</strong><div class="text-sm text-slate-500">Tambahkan ke layar beranda untuk akses cepat.</div></div></div><div><button id="installBtn" class="px-4 py-2 bg-indigo-600 text-white rounded">Pasang</button> <button id="dismissInstall" class="px-3 py-2 text-slate-600">Tutup</button></div>`;
            document.body.appendChild(installBanner);

            document.getElementById('installBtn').addEventListener('click', async () => {
                installBanner.remove();
                deferredPrompt.prompt();
                const choiceResult = await deferredPrompt.userChoice;
                deferredPrompt = null;
                console.log('PWA install choice:', choiceResult.outcome);
            });

            document.getElementById('dismissInstall').addEventListener('click', () => {
                installBanner.remove();
            });
        });
    </script>
</body>

</html>