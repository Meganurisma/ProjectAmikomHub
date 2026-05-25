<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Event::with('category')
            ->where('date', '>=', now())
            ->orderBy('date', 'asc');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $events = $query->get();
        $selectedCategory = $request->category;

        // Get all partners for display
        $partners = Partner::latest()->get();

        return view('welcome', compact('events', 'categories', 'selectedCategory', 'partners'));
    }
}
