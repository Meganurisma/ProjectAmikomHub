@extends('layouts.admin')

@section('content')
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Manajemen Kategori</h1>
            <p class="text-slate-500 font-medium">Kelola kategori event Anda dengan mudah.</p>
        </div>
        <button
            class="px-6 py-3 bg-emerald-600 text-white rounded-2xl font-bold shadow-lg shadow-emerald-100 hover:bg-emerald-700 active:scale-95 transition flex items-center gap-2">
            <i class="fa-solid fa-plus w-5 h-5"></i>
            Tambah Kategori
        </button>
    </header>

    <div class="bg-white rounded-2xl border border-emerald-100 shadow-md overflow-hidden">
        <div class="px-8 py-6 bg-gradient-to-r from-emerald-50 to-emerald-100 border-b border-emerald-200 flex gap-4">
            <input type="text" placeholder="Cari kategori..."
                class="flex-1 px-5 py-3 rounded-lg border-emerald-200 border bg-white focus:ring-2 focus:ring-emerald-500 outline-none transition">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white uppercase text-xs font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-4 w-16">No</th>
                        <th class="px-8 py-4">Nama Kategori</th>
                        <th class="px-8 py-4">Deskripsi</th>
                        <th class="px-8 py-4">Jumlah Event</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-emerald-100 border-t border-emerald-100">
                    @forelse($categories as $index => $category)
                    <tr class="hover:bg-emerald-50 transition">
                        <td class="px-8 py-5 font-bold text-emerald-600">{{ $index + 1 }}</td>
                        <td class="px-8 py-5">
                            <p class="font-bold text-slate-800">{{ $category->name }}</p>
                        </td>
                        <td class="px-8 py-5 text-slate-600">{{ $category->description }}</td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-sm font-semibold">{{ $category->event_count }} Event</span>
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
                            <p class="font-medium">Tidak ada kategori</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection