@extends('Layouts.admin')

@section('content')
    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-black">Audit WhatsApp Reminder</h1>
            <p class="text-slate-500 font-medium">Catatan pengiriman notifikasi WhatsApp untuk transaksi yang ditinggalkan.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-8 py-6 bg-slate-50/50 border-b">
            <p class="text-sm text-slate-600">Lihat log pengiriman WhatsApp, status terkirim/gagal, dan detail order untuk audit pemulihan keranjang.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Waktu</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Order ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Organisasi / Event</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Nomor</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Provider</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Pesan</th>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Response</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($logs as $log)
                        <tr class="hover:bg-slate-50">
                            <td class="px-8 py-5 text-sm text-slate-700">{{ $log->created_at->format('d M Y H:i') }}</td>
                            <td class="px-8 py-5 text-sm text-slate-700">{{ $log->order_id ?? '-' }}</td>
                            <td class="px-8 py-5 text-sm text-slate-700">
                                <div>{{ optional($log->organization)->name ?? '—' }}</div>
                                <div class="text-xs text-slate-500">{{ optional($log->event)->title ?? 'No event' }}</div>
                            </td>
                            <td class="px-8 py-5 text-sm text-slate-700">{{ $log->recipient_phone }}</td>
                            <td class="px-8 py-5 text-sm {{ $log->status === 'sent' ? 'text-emerald-700' : 'text-red-600' }} font-semibold">{{ ucfirst($log->status) }}</td>
                            <td class="px-8 py-5 text-sm text-slate-700">{{ $log->provider }}</td>
                            <td class="px-8 py-5 text-sm text-slate-700 break-words max-w-xs">{{ $log->message }}</td>
                            <td class="px-8 py-5 text-sm text-slate-700 break-words max-w-xs">{{ \Illuminate\Support\Str::limit(json_encode($log->response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), 120) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-6 text-center text-sm text-gray-500" colspan="7">Belum ada catatan pengingat WhatsApp.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-8 py-6 bg-slate-50/50 border-t flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <p class="text-sm text-slate-500">Menampilkan {{ $logs->count() }} catatan</p>
            <div>
                {{ $logs->links() }}
            </div>
        </div>
    </div>
@endsection
