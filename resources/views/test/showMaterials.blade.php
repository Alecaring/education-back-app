@extends('layouts.admin')

@section('content')
    <div class="container my-4">
        <!-- Title of the Module -->
        <h1 class="mb-4">{{ $modulo->title }} di {{ $modulo->content }}</h1>

        <!-- List of Materials -->
        <ul class="list-group">
            @foreach ($materiale as $item)
                <li class="list-group-item">
                    <!-- Display the description with HTML content -->
                    <div class="mb-2">{!! $item->description !!}</div>

                    <!-- Display the image if the file URL is provided -->
                    @if ($item->file_url)
                        <img src="{{ asset('storage/' . $item->file_url) }}" alt="Material Image" class="img-fluid">
                    @else
                        <p>No image available.</p>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endsection
