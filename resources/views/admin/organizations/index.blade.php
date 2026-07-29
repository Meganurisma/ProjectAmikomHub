@extends('Layouts.admin')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-bold">Organizations</h2>
        <a href="{{ route('admin.organizations.create') }}" class="btn">Create</a>
    </div>

    <table class="w-full">
        <thead>
            <tr><th>Name</th><th>Slug</th><th>Email</th><th></th></tr>
        </thead>
        <tbody>
            @foreach($orgs as $org)
            <tr>
                <td>{{ $org->name }}</td>
                <td>{{ $org->slug }}</td>
                <td>{{ $org->email }}</td>
                <td>
                    <a href="{{ route('admin.organizations.edit', $org) }}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $orgs->links() }}
    </div>
</div>
@endsection
