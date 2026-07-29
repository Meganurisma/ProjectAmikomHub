<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use App\Mail\ReviewRequestMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendReviewRequests extends Command
{
    protected $signature = 'reviews:send-requests';

    protected $description = 'Send review request emails for events that finished yesterday.';

    public function handle()
    {
        $yesterdayStart = Carbon::yesterday()->startOfDay();
        $yesterdayEnd = Carbon::yesterday()->endOfDay();

        $transactions = Transaction::whereHas('event', function ($q) use ($yesterdayStart, $yesterdayEnd) {
            $q->whereBetween('date', [$yesterdayStart, $yesterdayEnd]);
        })->get();

        foreach ($transactions as $tx) {
            $event = $tx->event;
            Mail::to($tx->customer_email)->queue(new ReviewRequestMail($event, $tx));
        }

        $this->info('Review request emails queued for ' . $transactions->count() . ' transactions.');
    }
}
