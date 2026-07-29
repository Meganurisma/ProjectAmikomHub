<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\WhatsAppService;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('event')->latest()->paginate(20);

        return view('admin.transactions', [
            'transactions' => $transactions,
        ]);
    }

    public function resendReminder(Request $request, Transaction $transaction)
    {
        // only resend for pending transactions
        if (strtolower($transaction->status) !== 'pending') {
            return back()->with('error', 'Hanya transaksi dengan status pending yang dapat dikirim pengingat.');
        }

        $wa = new WhatsAppService();
        $paymentUrl = url('/payment/' . $transaction->order_id);
        $message = "Halo {$transaction->customer_name},\nLanjutkan pembayaran tiket Anda: {$paymentUrl}";

        $result = $wa->send($transaction->customer_phone, $message);
        if ($result['status']) {
            $transaction->abandoned_reminder_sent_at = Carbon::now();
            $transaction->reminder_attempts = ($transaction->reminder_attempts ?? 0) + 1;
            $transaction->save();
            \App\Models\WhatsAppLog::create([
                'transaction_id' => $transaction->id,
                'event_id' => $transaction->event_id,
                'organization_id' => $transaction->organization_id,
                'order_id' => $transaction->order_id,
                'recipient_phone' => $transaction->customer_phone,
                'provider' => $result['provider'] ?? 'unknown',
                'status' => 'sent',
                'message' => $message,
                'payload' => $result['payload'] ?? [],
                'response' => $result['response'] ?? null,
            ]);
            return back()->with('success', 'Pengingat WhatsApp berhasil dikirim.');
        }

        \App\Models\WhatsAppLog::create([
            'transaction_id' => $transaction->id,
            'event_id' => $transaction->event_id,
            'organization_id' => $transaction->organization_id,
            'order_id' => $transaction->order_id,
            'recipient_phone' => $transaction->customer_phone,
            'provider' => $result['provider'] ?? 'unknown',
            'status' => 'failed',
            'message' => $message,
            'payload' => $result['payload'] ?? [],
            'response' => $result['response'] ?? null,
        ]);

        return back()->with('error', 'Gagal mengirim pengingat. Periksa konfigurasi WhatsApp.');
    }
}
