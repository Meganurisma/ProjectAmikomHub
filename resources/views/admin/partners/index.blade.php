@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex flex-col md:flex-row justify-between items-start gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold">Manajemen Partner</h2>
            <p class="text-slate-500 mt-1">Daftar partner dan form untuk menambahkan partner baru.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-5 border border-green-200">{{ session('success') }}</div>
    @endif

    <div class="grid gap-6 lg:grid-cols-[1fr_1.5fr]">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-xl font-semibold mb-4">Tambah Partner Baru</h3>
            <form action="{{ route('admin.partners.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block mb-2 font-medium text-gray-700">Nama Partner</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 p-3 rounded focus:ring focus:ring-indigo-200" required>
                    @error('name')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 font-medium text-gray-700">URL Logo</label>
                    <input type="url" name="logo_url" value="{{ old('logo_url') }}" class="w-full border border-gray-300 p-3 rounded focus:ring focus:ring-indigo-200" placeholder="https://placehold.co/200x200" required>
                    @error('logo_url')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded font-semibold hover:bg-indigo-700 transition">Simpan Partner</button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 overflow-x-auto">
            <h3 class="text-xl font-semibold mb-4">Daftar Partner</h3>

            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="p-4 font-semibold text-gray-600">Nama Partner</th>
                        <th class="p-4 font-semibold text-gray-600">Logo</th>
                        <th class="p-4 font-semibold text-gray-600">URL Logo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($partners as $partner)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="p-4 text-gray-800">{{ $partner->name }}</td>
                            <td class="p-4">
                                <img src="{{ $partner->logo_url }}" alt="Logo {{ $partner->name }}" class="h-14 w-14 object-cover rounded shadow-sm">
                            </td>
                            <td class="p-4 text-indigo-600 break-all">{{ $partner->logo_url }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-4 text-sm text-slate-500">Belum ada partner. Tambahkan partner baru menggunakan form di samping.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
