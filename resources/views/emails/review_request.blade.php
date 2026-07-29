<p>Halo {{ $transaction->customer_name }},</p>

<p>Terima kasih telah menghadiri acara <strong>{{ $event->title }}</strong>. Kami harap Anda menikmati acaranya.</p>

<p>Silakan berikan penilaian dan testimoni Anda untuk membantu penyelenggara dan calon peserta lainnya:</p>

<p><a href="{{ url('/events/' . $event->id) }}">Berikan Ulasan</a></p>

<p>Terima kasih.</p>
