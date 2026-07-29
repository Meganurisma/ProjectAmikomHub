<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Schema::hasTable('categories') ? Category::all() : collect();

        $query = Event::query();

        if (Schema::hasTable('events')) {
            $query = Event::with('category')
                ->where('date', '>=', now())
                ->orderBy('date', 'asc');

            if ($request->filled('category')) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            }
        }

        $events = Schema::hasTable('events') ? $query->get() : collect();
        $selectedCategory = $request->category;

        $partners = Schema::hasTable('partners') ? Partner::latest()->get() : collect();

        return view('welcome', compact('events', 'categories', 'selectedCategory', 'partners'));
    }
}
