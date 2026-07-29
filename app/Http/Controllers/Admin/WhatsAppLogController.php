<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsAppLog;
use Illuminate\Http\Request;

class WhatsAppLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = WhatsAppLog::with(['transaction', 'event', 'organization'])
            ->latest()
            ->paginate(20);

        return view('admin.whatsapp_logs.index', compact('logs'));
    }
}
