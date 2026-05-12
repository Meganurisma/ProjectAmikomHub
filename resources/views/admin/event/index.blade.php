@extends('layouts.admin')
@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manajemen Event</h2>
        <a href="{{ route('admin.events.create') }}"
class="bg-indigo-600 text-white px-4 py-2 rounded fontsemibold hover:bg-indigo-700">Tambah Event</a>
 </div>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded
mb-5 border border-green-200">{{ session('success')
}}</div>
 @endif
 <div class="overflow-x-auto">
    <table class="w-full bg-white rounded-lg shadow-sm
border border-gray-200 text-left">
 <thead>
 <tr class="bg-gray-50 border-b border-gray-200">
 <th class="p-4 font-semibold text-gray-600">Judul
Event</th>
 <th class="p-4 font-semibold text-gray-600">
Kategori</th>
 <th class="p-4 font-semibold text-gray-600">
Tanggal</th>
 <th class="p-4 font-semibold text-gray-600">Aksi
Pilihan</th>
 </tr>
 </thead>
 <tbody>
    @foreach($events as $event)
 <tr class="border-b border-gray-100 hover:bg-gray50">
 <td class="p-4 text-gray-800">{{ $event->title }}
</td>
    <td class="p-4 text-indigo-600">{{ $event->category-
>name ?? '-' }}</td>
    <td class="p-4 text-gray-600">{{ \Carbon\Carbon::
parse($event->date)->format('d M Y, H:i') }}</td>
    <td class="p-4 flex gap-2">
 <!-- Catatan Modul: Deretan tombol fitur modifikasi (U dan
D) akan ditanamkan pada tahap berikutnya -->
    </td>
    </tr>
    @endforeach
    </tbody>
    </table
    </div>
</div>
@endsection