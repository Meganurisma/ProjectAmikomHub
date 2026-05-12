<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show()
    {
        return view('event-detail');
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function ticket()
    {
        return view('ticket');
    }

    public function indexAdmin()
    {
        // Temporary event data - akan diganti dengan data dari database
        $events = [
            (object)[
                'id' => 1,
                'title' => 'Jazz Night 2024: A Celebration of Rhythm & Melody',
                'category' => 'Music Festival',
                'date' => '16 Nov 2024',
                'location' => 'The Blue Note Lounge',
                'price' => 'Rp 150.000',
                'capacity' => 500,
                'sold' => 342,
                'status' => 'Active',
                'image' => 'concert.png'
            ],
            (object)[
                'id' => 2,
                'title' => 'AI & Future: Unleash The Power',
                'category' => 'Technology',
                'date' => '26 Oct 2024',
                'location' => 'Tech Hub Metropolis',
                'price' => 'Rp 50.000',
                'capacity' => 300,
                'sold' => 145,
                'status' => 'Active',
                'image' => 'workshop.png'
            ],
            (object)[
                'id' => 3,
                'title' => 'Hackathon 2024: Ultimate Marathon',
                'category' => 'Coding',
                'date' => '18-20 Oct 2024',
                'location' => 'Campus Center',
                'price' => 'Gratis',
                'capacity' => 200,
                'sold' => 189,
                'status' => 'Active',
                'image' => 'hackathon.png'
            ]
        ];

        return view('admin.events', [
            'events' => $events
        ]);
    }
    public function create()
{
    $categories = \App\Models\Category::all();
     return view('admin.events.create',
compact('categories'));
}
public function store(\Illuminate\Http\Request $request)
{
 // Menerapkan validasi data request dari pengguna
 $data = $request->validate([
    'category_id' => 'required',
    'title' => 'required|string|max:255',
    'description' => 'required|string',
    'date' => 'required|date',
    'location' => 'required|string|max:255',
    'price' => 'required|numeric',
    'stock' => 'required|numeric'
    ]);
 // Menyimpan data yang telah divalidasi ke dalam tabel moenggunakan model
    \App\Models\Event::create($data);
 return redirect()->route('admin.events.index')-
>with('success', 'Data Event berhasil ditambahkan.');
}
}