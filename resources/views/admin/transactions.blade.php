@extends('layouts.admin')

@section('content')

<!-- Header Atas -->
<div class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-3xl font-black">Laporan Transaksi</h1>
        <p class="text-slate-500 font-medium">Pantau arus kas dan penjualan tiket Anda.</p>
    </div>

    <div class="flex gap-4">
        <button class="px-6 py-3 border-2 border-slate-200 rounded-2xl font-bold hover:bg-white hover:text-indigo-600 flex items-center gap-2">
            <i class="fa-solid fa-file-excel w-5 h-5"></i>
            Ekspor Excel
        </button>
        <button class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 flex items-center gap-2">
            <i class="fa-solid fa-file-pdf w-5 h-5"></i>
            Unduh PDF
        </button>
    </div>
</div>

<!-- Filter + Table -->
<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">

    <!-- Filter -->
    <div class="px-8 py-6 bg-slate-50/50 border-b flex flex-wrap gap-4 items-center">

        <input type="text" placeholder="Cari Order ID, Nama, atau Email..."
            class="flex-1 px-5 py-3 rounded-xl border border-slate-200 bg-white outline-none">

        <select class="px-5 py-3 rounded-xl border border-slate-200 bg-white">
            <option>Semua Status</option>
            <option>Success</option>
            <option>Pending</option>
            <option>Expired</option>
        </select>

        <select class="px-5 py-3 rounded-xl border border-slate-200 bg-white">
            <option>Bulan Ini</option>
            <option>Bulan Lalu</option>
            <option>Tahun 2024</option>
        </select>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">

            <thead class="bg-slate-50 text-slate-400 uppercase text-xs font-bold">
                <tr>
                    <th class="px-8 py-4">Order ID</th>
                    <th class="px-8 py-4">Pembeli</th>
                    <th class="px-8 py-4">Event</th>
                    <th class="px-8 py-4">Reminder</th>
                    <th class="px-8 py-4">Tanggal</th>
                    <th class="px-8 py-4">Status</th>
                    <th class="px-8 py-4 text-right">Total</th>
                </tr>
            </thead>

            <tbody class="divide-y border-t">
                @forelse($transactions as $transaction)
                <tr class="hover:bg-slate-50">
                    <td class="px-8 py-6 font-mono font-bold text-indigo-600">{{ $transaction->order_id }}</td>
                    <td class="px-8 py-6"> 
                        <p class="font-bold">{{ $transaction->customer_name }}</p>
                        <p class="text-xs text-slate-400">{{ $transaction->customer_email }}</p>
                        <p class="text-xs text-slate-400">{{ $transaction->customer_phone }}</p>
                    </td>
                    <td class="px-8 py-6 text-sm">
                        <p>Attempts: <strong>{{ $transaction->reminder_attempts ?? 0 }}</strong></p>
                        <p>Last: <strong>{{ $transaction->abandoned_reminder_sent_at?->format('d M Y H:i') ?? '-' }}</strong></p>
                        @if(strtolower($transaction->status) === 'pending')
                        <form action="{{ route('admin.transactions.resendReminder', $transaction) }}" method="POST">
                            @csrf
                            <button type="submit" class="mt-2 px-3 py-1 bg-indigo-600 text-white rounded text-xs">Kirim Ulang</button>
                        </form>
                        @endif
                    </td>
                    <td class="px-8 py-6">{{ $transaction->event->title ?? '-' }}</td>
                    <td class="px-8 py-6 text-sm text-slate-500">{{ $transaction->created_at?->format('d M Y, H:i') ?? '-' }}</td>
                    <td class="px-8 py-6">
                        @php
                            $status = strtolower($transaction->status);
                        @endphp
                        <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $status === 'pending' ? 'bg-amber-100 text-amber-700' : ($status === 'success' || $status === 'settlement' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600') }}">
                            {{ ucfirst($status) }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right font-bold">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-12 text-center text-slate-500">
                        <i class="fa-solid fa-inbox text-4xl mb-4 opacity-20"></i>
                        <p class="font-medium">Tidak ada data transaksi</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-8 py-6 bg-slate-50/50 border-t flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <p class="text-sm text-slate-500">Menampilkan {{ $transactions->count() }} data</p>
        <div>
            {{ $transactions->links() }}
        </div>
    </div>

</div>

@endsection