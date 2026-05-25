@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1 space-y-8">
            <span
                class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">
                #1 Event Platform
            </span>
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
            </h1>
            <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan
                Midtrans.
            </p>
            <div class="flex gap-4">
                <a href="#events"
                    class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform flex items-center gap-2">
                    <i class="fa-solid fa-arrow-right w-5 h-5"></i>
                    Mulai Jelajah
                </a>
                <a href="#"
                    class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition flex items-center gap-2">
                    <i class="fa-solid fa-circle-info w-5 h-5"></i>
                    Cara Pesan
                </a>
            </div>
        </div>
        <div class="flex-1 relative">
            <div
                class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>
            <img src="{{ asset('assets/concert.png') }}" alt="Concert"
                class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

            <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                        <i class="fa-solid fa-check text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                        <p class="font-bold">Pembayaran Aman via Midtrans</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Grid -->
    <section id="events" class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
                <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
            </div>
            <div class="mb-8 flex flex-wrap gap-3 justify-center">
                <a href="/"
                    class="px-5 py-2 rounded-full font-semibold transition duration-300 {{ request()->has('category') ? 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' : 'bg-indigo-600 text-white shadow-lg' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="?category={{ $cat->slug }}"
                        class="px-5 py-2 rounded-full font-semibold transition duration-300 border {{ request('category') == $cat->slug ? 'bg-indigo-600 text-white border-indigo-600 shadow-lg' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($events as $event)
                <div
                    class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="relative overflow-hidden bg-slate-200 h-80 rounded-t-3xl flex items-center justify-center">
                        <span class="text-slate-400 text-xl font-semibold">200 x 600</span>
                        <div
                            class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-full text-[10px] font-bold uppercase tracking-[0.2em] text-indigo-600 border border-indigo-100">
                            {{ $event->category->name }}
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-slate-900">
                            {{ $event->title }}
                        </h3>

                        <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                            <i class="fa-solid fa-clock w-4 h-4 text-center"></i>
                            <span>{{ $event->date }}</span>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t">
                            <span class="text-2xl font-black text-indigo-600">
                                Rp {{ number_format($event->price, 0, ',', '.') }}
                            </span>

                            <a href="{{ route('event.detail') }}"
                                class="px-4 py-2 bg-white text-indigo-600 rounded-full font-bold border border-indigo-100 hover:bg-indigo-600 hover:text-white transition flex items-center gap-2">
                                <i class="fa-solid fa-eye w-4 h-4"></i>
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Partners Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 border-t border-slate-100">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold mb-2">Partner Kami</h2>
            <p class="text-slate-500 font-medium">Dipercaya oleh partner-partner terkemuka di seluruh Indonesia</p>
        </div>

        @if($partners->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 items-center">
                @foreach($partners as $partner)
                    <div
                        class="bg-white rounded-2xl border border-slate-100 p-8 hover:shadow-lg transition-all duration-300 flex items-center justify-center min-h-24">
                        @if($partner->logo_url)
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="h-12 object-contain max-w-full">
                        @else
                            <div class="text-center">
                                <p class="font-bold text-slate-700 text-sm">{{ $partner->name }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 text-slate-500">
                <p class="font-medium">Belum ada partner</p>
            </div>
        @endif
    </section>
@endsection