<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        $orgs = Organization::latest()->paginate(10);
        return view('admin.organizations.index', compact('orgs'));
    }

    public function create()
    {
        return view('admin.organizations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:organizations,slug',
            'email' => 'nullable|email',
        ]);

        Organization::create($data);
        return redirect()->route('admin.organizations.index')->with('success', 'Organization created');
    }

    public function edit(Organization $organization)
    {
        return view('admin.organizations.edit', compact('organization'));
    }

    public function update(Request $request, Organization $organization)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:organizations,slug,' . $organization->id,
            'email' => 'nullable|email',
        ]);

        $organization->update($data);
        return redirect()->route('admin.organizations.index')->with('success', 'Organization updated');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();
        return redirect()->route('admin.organizations.index')->with('success', 'Organization deleted');
    }
}
