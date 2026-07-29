<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $isOrg = auth()->user() && auth()->user()->role === 'org_admin';
        $orgId = $isOrg ? auth()->user()->organization_id : null;

        $baseTxQuery = Transaction::whereIn('status', ['settlement', 'success']);
        $basePendingQuery = Transaction::where('status', 'pending');
        $eventsQuery = Event::where('date', '>=', now());
        $recentTxQuery = Transaction::with('event')->latest();

        if ($isOrg) {
            $baseTxQuery->where('organization_id', $orgId);
            $basePendingQuery->where('organization_id', $orgId);
            $eventsQuery->where('organization_id', $orgId);
            $recentTxQuery->where('organization_id', $orgId);
        }

        $totalRevenue = $baseTxQuery->sum('total_price');
        $ticketsSold = $baseTxQuery->count();
        $activeEvents = $eventsQuery->count();
        $pendingOrders = $basePendingQuery->count();
        $recentTransactions = $recentTxQuery->take(5)->get();

        // Prepare growth chart data for last 30 days
        $days = 30;
        $dates = [];
        $userCounts = [];
        $eventCounts = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dates[] = $date->format('Y-m-d');

            $userQuery = User::whereDate('created_at', $date);
            $eventQuery = Event::whereDate('created_at', $date);
            if ($isOrg) {
                $userQuery->where('organization_id', $orgId);
                $eventQuery->where('organization_id', $orgId);
            }
            $userCounts[] = $userQuery->count();
            $eventCounts[] = $eventQuery->count();
        }

        return view('admin.dashboard', compact(
            'totalRevenue', 'ticketsSold', 'activeEvents', 'pendingOrders', 'recentTransactions',
            'dates', 'userCounts', 'eventCounts'
        ));
    }
}
