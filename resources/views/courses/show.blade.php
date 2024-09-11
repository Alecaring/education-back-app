@extends('layouts.admin')

@section('title', 'Course Details')

@section('content')
    <div class="my-4">
        <h1>Course Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $course->name }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $course->description }}</p>
                <p class="card-text"><strong>Level:</strong> {{ ucfirst($course->level) }}</p>
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
