@extends('layouts.app')
@section('title', 'Pembayaran - ' . $transaction->event->title)
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg animate-bounce-in">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-credit-card" style="font-size: 3rem; color: #007bff;"></i>
                    </div>

                    <h2 class="text-center mb-3">Selesaikan Pembayaran</h2>

                    <p class="text-center text-muted mb-4">
                        Mohon selesaikan pembayaran tiket Anda untuk event <strong>{{ $transaction->event->title }}</strong>.
                    </p>

                    <div class="alert alert-info mb-4">
                        <h5 class="mb-3">Total Tagihan</h5>
                        <h3 class="mb-2">
                            Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                        </h3>
                        <small class="text-muted">Order ID: {{ $transaction->order_id }}</small>
                    </div>

                    <button id="pay-button" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-lock"></i> Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"></script>
<script>
document.getElementById('pay-button').onclick = function () {
    // SnapToken acquired from previous step
    snap.pay('{{ $transaction->snap_token }}', {
        // Optional
        onSuccess: function(result){
            window.location.href = "{{ route('checkout.success', $transaction->order_id) }}";
        },
        // Optional
        onPending: function(result){
            window.location.href = "{{ route('checkout.success', $transaction->order_id) }}";
        },
        // Optional
        onError: function(result){
            alert("Pembayaran Gagal!");
        }
    });
};

// Auto trigger
window.onload = function() {
    document.getElementById('pay-button').click();
}
</script>

<style>
@keyframes bounce-in {
    0% { transform: scale(0.9); opacity: 0; }
    70% { transform: scale(1.05); opacity: 1; }
    100% { transform: scale(1); }
}
.animate-bounce-in { animation: bounce-in 0.4s ease-out forwards; }
</style>

@endsection
