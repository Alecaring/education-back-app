@extends('layouts.admin')

@section('title', 'Question Details')

@section('content')
    <div class="my-4">
        <h1>Question Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $quizQuestion->question }}</h5>
                <p class="card-text"><strong>Quiz:</strong> {{ $quizQuestion->quiz->title }}</p>
                <a href="{{ route('quiz_questions.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
