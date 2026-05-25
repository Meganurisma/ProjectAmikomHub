@extends('layouts.admin')

@section('content')
    <header class="mb-10">
        <a href="{{ route('admin.partners.index') }}"
            class="text-emerald-600 hover:text-emerald-700 font-semibold flex items-center gap-2 mb-4">
            <i class="fa-solid fa-arrow-left w-4 h-4"></i>
            Kembali
        </a>
        <h1 class="text-3xl font-black">Edit Partner</h1>
        <p class="text-slate-500 font-medium">Perbarui informasi partner di bawah.</p>
    </header>

    <div class="bg-white rounded-2xl border border-emerald-100 shadow-md p-8 max-w-2xl">
        <form action="{{ route('admin.partners.update', $partner) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Partner <span
                        class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $partner->name) }}"
                    class="w-full px-5 py-3 border border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition @error('name') border-red-500 @enderror"
                    placeholder="Masukkan nama partner">
                @error('name')
                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo_url" class="block text-sm font-bold text-slate-700 mb-2">URL Logo</label>
                <input type="text" id="logo_url" name="logo_url" value="{{ old('logo_url', $partner->logo_url) }}"
                    class="w-full px-5 py-3 border border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition @error('logo_url') border-red-500 @enderror"
                    placeholder="Masukkan URL logo (opsional)">
                @error('logo_url')
                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
                @if($partner->logo_url)
                    <div class="mt-3">
                        <p class="text-sm text-slate-600 mb-2">Preview:</p>
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="h-16 w-auto object-contain">
                    </div>
                @endif
            </div>

            <div class="flex gap-4">
                <button type="submit"
                    class="px-6 py-3 bg-emerald-600 text-white rounded-lg font-bold hover:bg-emerald-700 transition">
                    <i class="fa-solid fa-save w-4 h-4 mr-2"></i>
                    Perbarui Partner
                </button>
                <a href="{{ route('admin.partners.index') }}"
                    class="px-6 py-3 bg-slate-200 text-slate-700 rounded-lg font-bold hover:bg-slate-300 transition">
                    <i class="fa-solid fa-x w-4 h-4 mr-2"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection