<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = [
            (object)[
                'name' => 'Musik',
                'description' => 'Konser, festival musik, dan acara musik lainnya',
                'event_count' => 12
            ],
            (object)[
                'name' => 'Teknologi',
                'description' => 'Workshop, seminar, dan hackathon tentang teknologi',
                'event_count' => 8
            ],
            (object)[
                'name' => 'Olahraga',
                'description' => 'Turnamen, marathon, dan kompetisi olahraga',
                'event_count' => 5
            ],
            (object)[
                'name' => 'Seni & Budaya',
                'description' => 'Pameran seni, pertunjukan teater, dan acara budaya',
                'event_count' => 7
            ]
        ];

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }
}