@extends('layouts.admin')

@section('content')
    <header class="mb-10">
        <a href="{{ route('admin.events.index') }}"
            class="text-emerald-600 hover:text-emerald-700 font-semibold flex items-center gap-2 mb-4">
            <i class="fa-solid fa-arrow-left w-4 h-4"></i>
            Kembali
        </a>
        <h1 class="text-3xl font-black">Edit Event</h1>
        <p class="text-slate-500 font-medium">Perbarui informasi event di bawah.</p>
    </header>

    <div class="bg-white rounded-2xl border border-emerald-100 shadow-md p-8 max-w-2xl">
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-sm font-bold text-slate-700 mb-2">Judul Event <span
                        class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}"
                    class="w-full px-5 py-3 border border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition @error('title') border-red-500 @enderror"
                    placeholder="Masukkan judul event" required>
                @error('title')
                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category_id" class="block text-sm font-bold text-slate-700 mb-2">Kategori Event <span
                        class="text-red-500">*</span></label>
                <select id="category_id" name="category_id"
                    class="w-full px-5 py-3 border border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition @error('category_id') border-red-500 @enderror"
                    required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Pendek <span
                        class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="3"
                    class="w-full px-5 py-3 border border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition @error('description') border-red-500 @enderror"
                    placeholder="Masukkan deskripsi event" required>{{ old('description', $event->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="date" class="block text-sm font-bold text-slate-700 mb-2">Tanggal & Waktu <span
                            class="text-red-500">*</span></label>
                    <input type="datetime-local" id="date" name="date" value="{{ old('date', $event->date) }}"
                        class="w-full px-5 py-3 border border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition @error('date') border-red-500 @enderror"
                        required>
                    @error('date')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="price" class="block text-sm font-bold text-slate-700 mb-2">Harga Tiket (Rp) <span
                            class="text-red-500">*</span></label>
                    <input type="number" id="price" name="price" value="{{ old('price', $event->price) }}"
                        class="w-full px-5 py-3 border border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition @error('price') border-red-500 @enderror"
                        placeholder="0" required>
                    @error('price')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="stock" class="block text-sm font-bold text-slate-700 mb-2">Kapasitas Stok <span
                            class="text-red-500">*</span></label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $event->stock) }}"
                        class="w-full px-5 py-3 border border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition @error('stock') border-red-500 @enderror"
                        placeholder="0" required>
                    @error('stock')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="location" class="block text-sm font-bold text-slate-700 mb-2">Lokasi / Gedung <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}"
                        class="w-full px-5 py-3 border border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition @error('location') border-red-500 @enderror"
                        placeholder="Masukkan lokasi event" required>
                    @error('location')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit"
                    class="px-6 py-3 bg-emerald-600 text-white rounded-lg font-bold hover:bg-emerald-700 transition">
                    <i class="fa-solid fa-save w-4 h-4 mr-2"></i>
                    Perbarui Event
                </button>
                <a href="{{ route('admin.events.index') }}"
                    class="px-6 py-3 bg-slate-200 text-slate-700 rounded-lg font-bold hover:bg-slate-300 transition">
                    <i class="fa-solid fa-x w-4 h-4 mr-2"></i>
                    Batal
                </a>
            </div>

            <div class="mb-6 mt-8">
                <label for="poster" class="block mb-2 font-medium text-slate-700">Poster event (Opsional)</label>
                <input type="file" id="poster" name="poster" accept="image/*"
                    class="w-full border border-emerald-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition @error('poster') border-red-500 @enderror">
                @error('poster')
                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </form>
    </div>
@endsection