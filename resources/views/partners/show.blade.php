@extends('Layouts.app')

@section('content')
<div class="container">
    <h1>{{ $partner->name }}</h1>

    <p>Rerata penilaian: {{ $average ? number_format($average, 1) : 'Belum ada' }} / 5</p>

    <h3>Ulasan</h3>
    @if($partner->reviews->isEmpty())
        <p>Belum ada ulasan untuk penyelenggara ini.</p>
    @else
        <ul>
            @foreach($partner->reviews as $review)
                <li>
                    <strong>{{ $review->user ? $review->user->name : 'Tamu' }}</strong>
                    - {{ $review->rating }} bintang
                    <div>{{ $review->comment }}</div>
                    <small>{{ $review->created_at->format('d M Y') }}</small>
                </li>
            @endforeach
        </ul>
    @endif

</div>
@endsection
