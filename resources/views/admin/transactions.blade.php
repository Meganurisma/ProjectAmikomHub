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
                        <p class="font-bold">{{ $transaction->buyer_name }}</p>
                        <p class="text-xs text-slate-400">{{ $transaction->buyer_email }}</p>
                    </td>
                    <td class="px-8 py-6">{{ $transaction->event_name }}</td>
                    <td class="px-8 py-6 text-sm text-slate-500">{{ $transaction->date }}</td>
                    <td class="px-8 py-6">
                        @if($transaction->status === 'Success')
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs">{{ $transaction->status }}</span>
                        @elseif($transaction->status === 'Pending')
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-lg text-xs">{{ $transaction->status }}</span>
                        @else
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs">{{ $transaction->status }}</span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-right font-bold">{{ $transaction->total }}</td>
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
    <div class="px-8 py-6 bg-slate-50/50 border-t flex justify-between items-center">
        <p class="text-sm text-slate-500">Menampilkan {{ count($transactions) }} data</p>

        <div class="flex gap-2">
            <button class="px-4 py-2 border rounded-xl text-sm flex items-center gap-2"><i class="fa-solid fa-chevron-left w-4 h-4"></i>Prev</button>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm">1</button>
            <button class="px-4 py-2 border rounded-xl text-sm">2</button>
            <button class="px-4 py-2 border rounded-xl text-sm flex items-center gap-2">Next<i class="fa-solid fa-chevron-right w-4 h-4"></i></button>
        </div>
    </div>

</div>

@endsection