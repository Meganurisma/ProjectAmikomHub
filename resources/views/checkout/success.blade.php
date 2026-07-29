@extends('layouts.app')
@section('title', 'Pembayaran Berhasil')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg animate-bounce-in">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle" style="font-size: 4rem; color: #28a745;"></i>
                    </div>

                    <h2 class="mb-3">Terima Kasih!</h2>

                    <p class="text-muted mb-4">
                        Pembayaran untuk pesanan <strong>{{ $transaction->order_id }}</strong> sedang diproses atau telah berhasil.
                        E-Ticket akan dikirim ke email Anda (<strong>{{ $transaction->customer_email }}</strong>) setelah pembayaran terkonfirmasi lunas.
                    </p>

                    <div class="alert alert-info mb-4">
                        <small>
                            <strong>Event:</strong> {{ $transaction->event->title }}<br>
                            <strong>Nama Pemesan:</strong> {{ $transaction->customer_name }}<br>
                            <strong>Total Pembayaran:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}<br>
                            <strong>Status:</strong> <span class="badge badge-info">{{ $transaction->status }}</span>
                        </small>
                    </div>

                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-home"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes bounce-in {
    0% { transform: scale(0.9); opacity: 0; }
    70% { transform: scale(1.05); opacity: 1; }
    100% { transform: scale(1); }
}
.animate-bounce-in { animation: bounce-in 0.4s ease-out forwards; }
</style>

@endsection
