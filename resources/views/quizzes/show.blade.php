@extends('layouts.admin')

@section('title', 'Quiz Details')

@section('content')
    <div class="my-4">
        <h1>Quiz Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $quiz->title }}</h5>
                <p class="card-text"><strong>Module:</strong> {{ $quiz->module->title }}</p>
                <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
