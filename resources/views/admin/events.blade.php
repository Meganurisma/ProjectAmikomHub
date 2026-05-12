@extends('layouts.admin')

@section('content')
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Kelola Event</h1>
            <p class="text-slate-500 font-medium">Buat dan atur acara seru Anda di sini.</p>
        </div>
        <button
            class="px-6 py-3 bg-emerald-600 text-white rounded-2xl font-bold shadow-lg shadow-emerald-100 hover:bg-emerald-700 active:scale-95 transition flex items-center gap-2">
            <i class="fa-solid fa-plus w-5 h-5"></i>
            Tambah Event Baru
        </button>
    </header>

    <div class="bg-white rounded-2xl border border-emerald-100 shadow-md overflow-hidden">
        <div class="px-8 py-6 bg-gradient-to-r from-emerald-50 to-emerald-100 border-b border-emerald-200 flex gap-4">
            <input type="text" placeholder="Cari nama event..."
                class="flex-1 px-5 py-3 rounded-lg border-emerald-200 border bg-white focus:ring-2 focus:ring-emerald-500 outline-none transition">
            <select class="px-5 py-3 rounded-lg border-emerald-200 border bg-white outline-none">
                <option>Semua Kategori</option>
                <option>Musik</option>
                <option>Workshop</option>
                <option>Olahraga</option>
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white uppercase text-xs font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-4 w-16">No</th>
                        <th class="px-8 py-4">Poster</th>
                        <th class="px-8 py-4">Event</th>
                        <th class="px-8 py-4">Harga / Stok</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-emerald-100 border-t border-emerald-100">
                    @forelse($events as $index => $event)
                    <tr class="hover:bg-emerald-50 transition">
                        <td class="px-8 py-5 font-bold text-emerald-600">{{ $index + 1 }}</td>
                        <td class="px-8 py-5">
                            <img src="{{ asset('assets/' . $event->image) }}" class="w-16 h-20 rounded-lg object-cover shadow-sm">
                        </td>
                        <td class="px-8 py-5">
                            <p class="font-black text-slate-800">{{ $event->title }}</p>
                            <p class="text-xs text-slate-400">{{ $event->category }} • {{ $event->date }}</p>
                        </td>
                        <td class="px-8 py-5">
                            <p class="font-bold text-emerald-600">{{ $event->price }}</p>
                            <p class="text-xs text-slate-400">Stok: {{ $event->sold }}/{{ $event->capacity }}</p>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex justify-end gap-2">
                                <button
                                    class="p-2.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-600 hover:text-white transition">
                                    <i class="fa-solid fa-pen-to-square w-4 h-4"></i>
                                </button>
                                <button
                                    class="p-2.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition">
                                    <i class="fa-solid fa-trash w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-slate-500">
                            <i class="fa-solid fa-inbox text-4xl mb-4 opacity-20"></i>
                            <p class="font-medium">Tidak ada event</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection