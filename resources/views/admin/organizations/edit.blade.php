@extends('Layouts.admin')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="font-bold mb-4">Edit Organization</h2>

    <form action="{{ route('admin.organizations.update', $organization) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input name="name" value="{{ $organization->name }}" class="w-full border p-2" required />
        </div>
        <div class="mb-3">
            <label>Slug</label>
            <input name="slug" value="{{ $organization->slug }}" class="w-full border p-2" required />
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input name="email" value="{{ $organization->email }}" class="w-full border p-2" />
        </div>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
    </form>
</div>
@endsection
