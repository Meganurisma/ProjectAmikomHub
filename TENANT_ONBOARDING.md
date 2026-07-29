Tenant Onboarding (Kepanitiaan/HIMA)

1. Jalankan migrasi:

```bash
composer require guzzlehttp/guzzle
php artisan migrate
```

2. Buat Organization baru (Admin):
- Masuk ke admin > Organizations > Create
- Isi `name`, `slug`, `email`.

3. Buat user organisasi (org_admin):
- Gunakan tinker atau admin UI untuk membuat user dengan `role = 'org_admin'` dan `organization_id` yang sesuai.

Contoh Tinker:

```bash
php artisan tinker
>>> \App\Models\User::create(['name'=>'Nama','email'=>'org@example.com','password'=>'password','role'=>'org_admin','organization_id'=>1]);
```

4. Konfigurasi WhatsApp API di `.env` (Twilio contoh default):
- `WHATSAPP_PROVIDER=twilio` (opsional — default `twilio`)
- `TWILIO_ACCOUNT_SID` = akun SID dari Twilio
- `TWILIO_AUTH_TOKEN` = auth token dari Twilio
- `TWILIO_WHATSAPP_FROM` = nomor WhatsApp Twilio Anda dalam format `whatsapp:+1415XXXXXXX`

Jika Anda ingin menggunakan provider lain, set `WHATSAPP_PROVIDER=generic` dan atur:
- `WHATSAPP_API_URL` = endpoint API provider
- `WHATSAPP_API_KEY` = token/API key (jika perlu)

5. Scheduler:
- Pastikan cron menjalankan `php artisan schedule:run` setiap menit di server.

6. Tes:
- Buat event untuk organisasi, jalankan checkout lalu jalankan:

```bash
php artisan cart:send-reminders --minutes=1
php artisan reviews:send-requests
```

Jika perlu adaptasi payload untuk provider WhatsApp tertentu (Twilio/Wablas/Fonnte), beri tahu saya provider-nya dan saya akan sesuaikan `WhatsAppService`.
