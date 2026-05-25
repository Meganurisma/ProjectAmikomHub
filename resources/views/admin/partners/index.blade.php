@extends('layouts.admin')

@section('content')
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Manajemen Partner</h1>
            <p class="text-slate-500 font-medium">Kelola partner dan sponsor dengan mudah.</p>
        </div>
        <a href="{{ route('admin.partners.create') }}"
            class="px-6 py-3 bg-emerald-600 text-white rounded-2xl font-bold shadow-lg shadow-emerald-100 hover:bg-emerald-700 active:scale-95 transition flex items-center gap-2">
            <i class="fa-solid fa-plus w-5 h-5"></i>
            Tambah Partner
        </a>
    </header>

    @if ($message = Session::get('success'))
        <div
            class="mb-6 px-6 py-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 font-medium flex items-center gap-2">
            <i class="fa-solid fa-check-circle w-5 h-5"></i>
            {{ $message }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-emerald-100 shadow-md overflow-hidden">
        <div class="px-8 py-6 bg-gradient-to-r from-emerald-50 to-emerald-100 border-b border-emerald-200">
            <form action="{{ route('admin.partners.index') }}" method="GET" class="flex gap-4">
                <input type="text" name="search" placeholder="Cari partner..." value="{{ request('search') }}"
                    class="flex-1 px-5 py-3 rounded-lg border-emerald-200 border bg-white focus:ring-2 focus:ring-emerald-500 outline-none transition">
                <button type="submit"
                    class="px-6 py-3 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">
                    <i class="fa-solid fa-magnifying-glass w-4 h-4"></i>
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead
                    class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white uppercase text-xs font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-4">Nama Partner</th>
                        <th class="px-8 py-4">Logo</th>
                        <th class="px-8 py-4">Dibuat</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-emerald-100 border-t border-emerald-100">
                    @forelse($partners as $partner)
                        <tr class="hover:bg-emerald-50 transition">
                            <td class="px-8 py-5">
                                <p class="font-bold text-slate-800">{{ $partner->name }}</p>
                            </td>
                            <td class="px-8 py-5">
                                @if($partner->logo_url)
                                    <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                                        class="h-10 w-auto object-contain">
                                @else
                                    <span class="text-slate-400 text-sm">-</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-slate-600">{{ $partner->created_at->format('d M Y') }}</td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.partners.edit', $partner) }}"
                                        class="p-2.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-600 hover:text-white transition">
                                        <i class="fa-solid fa-pen-to-square w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('Yakin ingin menghapus partner ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition">
                                            <i class="fa-solid fa-trash-alt w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-8 text-center text-slate-500 font-medium">Tidak ada partner ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($partners->hasPages())
        <div class="mt-6">
            {{ $partners->links() }}
        </div>
    @endif
@endsection