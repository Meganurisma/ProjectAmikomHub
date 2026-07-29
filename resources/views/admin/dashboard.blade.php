@extends('Layouts.admin')

@section('content')
<div class="grid grid-cols-3 gap-6">
    <div class="col-span-2 bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-bold mb-4">Growth Overview (30 hari)</h2>
        <canvas id="growthChart" height="120"></canvas>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-bold">Ringkasan</h3>
        <ul class="mt-4 space-y-2">
            <li>Total Pendapatan: <strong>Rp {{ number_format($totalRevenue) }}</strong></li>
            <li>Tiket Terjual: <strong>{{ $ticketsSold }}</strong></li>
            <li>Event Aktif: <strong>{{ $activeEvents }}</strong></li>
            <li>Pesanan Pending: <strong>{{ $pendingOrders }}</strong></li>
        </ul>
    </div>
</div>

<div class="mt-8 bg-white p-6 rounded-lg shadow">
    <h3 class="font-bold mb-4">Riwayat Transaksi Terbaru</h3>
    <table class="w-full text-left">
        <thead>
            <tr>
                <th>Order</th>
                <th>Nama</th>
                <th>Event</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentTransactions as $tx)
            <tr>
                <td>{{ $tx->order_id }}</td>
                <td>{{ $tx->customer_name }}</td>
                <td>{{ $tx->event ? $tx->event->title : '-' }}</td>
                <td>{{ $tx->status }}</td>
                <td>{{ $tx->created_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($dates);
    const users = @json($userCounts);
    const events = @json($eventCounts);

    const ctx = document.getElementById('growthChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                { label: 'Pengguna Baru', data: users, borderColor: '#3b82f6', fill: false },
                { label: 'Event Baru', data: events, borderColor: '#10b981', fill: false }
            ]
        },
        options: { responsive: true }
    });
</script>

@endsection
