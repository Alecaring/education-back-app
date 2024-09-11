@extends('layouts.admin')

@section('title', 'Edit Answer')

@section('content')
    <div class="my-4">
        <h1>Edit Answer</h1>
        <form action="{{ route('quiz_answers.update', $quizAnswer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="question_id" class="form-label">Question</label>
                <select name="question_id" id="question_id" class="form-select" required>
                    @foreach($questions as $question)
                        <option value="{{ $question->id }}" {{ $quizAnswer->question_id == $question->id ? 'selected' : '' }}>
                            {{ $question->question }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="answer" class="form-label">Answer</label>
                <textarea name="answer" id="answer" class="form-control" rows="3" required>{{ $quizAnswer->answer }}</textarea>
            </div>
            <div class="mb-3">
                <label for="is_correct" class="form-label">Is Correct?</label>
                <select name="is_correct" id="is_correct" class="form-select" required>
                    <option value="1" {{ $quizAnswer->is_correct ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$quizAnswer->is_correct ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('quiz_answers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
