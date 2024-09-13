@extends('layouts.admin')

@section('content')
    <div class="container my-4">
        <div class="row">
            @foreach ($corsi as $corso)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="{{ route('test.show', $corso->id) }}">
                            <img class="card-img-top" src="{{ asset('storage/' . $corso->coverImgCourses) }}" alt="Course Image">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $corso->name }}</h5>
                            <p class="card-text">{{ $corso->description }}</p>
                            <p class="card-text"><strong>Level:</strong> {{ ucfirst($corso->level) }}</p>
                            <a href="{{ route('test.show', $corso->id) }}" class="btn btn-primary mt-auto">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
