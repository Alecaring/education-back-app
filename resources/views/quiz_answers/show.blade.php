@extends('layouts.admin')

@section('title', 'Answer Details')

@section('content')
    <div class="my-4">
        <h1>Answer Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $quizAnswer->answer }}</h5>
                <p class="card-text"><strong>Question:</strong> {{ $quizAnswer->question->question }}</p>
                <p class="card-text"><strong>Correct:</strong> {{ $quizAnswer->is_correct ? 'Yes' : 'No' }}</p>
                <a href="{{ route('quiz_answers.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
