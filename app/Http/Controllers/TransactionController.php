<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // Temporary data - akan diganti dengan data dari database
        $transactions = [
            (object)[
                'order_id' => '#TRX-99210',
                'buyer_name' => 'Donni Prabowo',
                'buyer_email' => 'donni@example.com',
                'event_name' => 'Jazz Night 2024',
                'date' => '26 Mar 2024',
                'status' => 'Success',
                'total' => 'Rp 155.000'
            ],
            (object)[
                'order_id' => '#TRX-99209',
                'buyer_name' => 'Maya Sari',
                'buyer_email' => 'maya@example.com',
                'event_name' => 'AI Workshop',
                'date' => '26 Mar 2024',
                'status' => 'Pending',
                'total' => 'Rp 55.000'
            ],
            (object)[
                'order_id' => '#TRX-99208',
                'buyer_name' => 'Budi Santoso',
                'buyer_email' => 'budi@example.com',
                'event_name' => 'Hackathon 2024',
                'date' => '25 Mar 2024',
                'status' => 'Free',
                'total' => 'Rp 0'
            ]
        ];

        return view('admin.transactions', [
            'transactions' => $transactions
        ]);
    }
}
