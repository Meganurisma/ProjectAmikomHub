<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use App\Services\WhatsAppService;
use Carbon\Carbon;

class SendAbandonedCartReminders extends Command
{
    protected $signature = 'cart:send-reminders {--minutes=30}';

    protected $description = 'Send WhatsApp reminders for abandoned pending transactions older than X minutes.';

    public function handle()
    {
        $minutes = (int) $this->option('minutes');
        $threshold = Carbon::now()->subMinutes($minutes);

        $txs = Transaction::where('status', 'pending')
            ->where('created_at', '<=', $threshold)
            ->where(function ($q) {
                $q->whereNull('abandoned_reminder_sent_at')->orWhere('reminder_attempts', '<', 3);
            })
            ->get();

        $wa = new WhatsAppService();
        $sent = 0;

        foreach ($txs as $tx) {
            if (! $tx->customer_phone) {
                continue;
            }

            $paymentUrl = url('/payment/' . $tx->order_id);
            $message = "Halo {$tx->customer_name},\nAnda meninggalkan pembayaran untuk acara. Selesaikan pembayaran melalui link berikut: {$paymentUrl}";

            $result = $wa->send($tx->customer_phone, $message);
            if ($result['status']) {
                $tx->abandoned_reminder_sent_at = Carbon::now();
                $tx->reminder_attempts = ($tx->reminder_attempts ?? 0) + 1;
                $tx->save();
                $sent++;
            }

            \App\Models\WhatsAppLog::create([
                'transaction_id' => $tx->id,
                'event_id' => $tx->event_id,
                'organization_id' => $tx->organization_id,
                'order_id' => $tx->order_id,
                'recipient_phone' => $tx->customer_phone,
                'provider' => $result['provider'] ?? 'unknown',
                'status' => $result['status'] ? 'sent' : 'failed',
                'message' => $message,
                'payload' => $result['payload'] ?? [],
                'response' => $result['response'] ?? null,
            ]);
        }

        $this->info("Abandoned reminders sent: {$sent}");
    }
}
