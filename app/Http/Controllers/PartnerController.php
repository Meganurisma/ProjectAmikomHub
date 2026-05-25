<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Partner::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        $partners = $query->latest()->paginate(10);

        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:partners',
            'logo_url' => 'nullable|string|max:500',
        ]);

        Partner::create($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:partners,name,' . $partner->id,
            'logo_url' => 'nullable|string|max:500',
        ]);

        $partner->update($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus.');
    }
}
