<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:2000'
        ]);

        // ensure event finished at least one day ago
        $eventDate = Carbon::parse($event->date);
        if ($eventDate->gt(Carbon::now()->subDay())) {
            return back()->with('error', 'Ulasan hanya dapat diberikan sehari setelah acara selesai.');
        }

        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }

        // verify user has a transaction for this event
        $hasTx = Transaction::where('event_id', $event->id)
            ->where('customer_email', $user->email)
            ->exists();

        if (! $hasTx) {
            return back()->with('error', 'Hanya peserta yang hadir yang dapat memberi ulasan.');
        }

        $review = Review::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'partner_id' => $event->partner_id,
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment')
        ]);

        // set organization_id on review when possible
        if ($event->organization_id) {
            $review->organization_id = $event->organization_id;
            $review->save();
        }

        return back()->with('success', 'Terima kasih atas ulasannya.');
    }
}
