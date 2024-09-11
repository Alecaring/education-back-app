@extends('layouts.admin')

@section('title', 'Create Answer')

@section('content')
    <div class="my-4">
        <h1>Create Answer</h1>
        <form action="{{ route('quiz_answers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="question_id" class="form-label">Question</label>
                <select name="question_id" id="question_id" class="form-select" required>
                    @foreach($questions as $question)
                        <option value="{{ $question->id }}">{{ $question->question }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="answer" class="form-label">Answer</label>
                <textarea name="answer" id="answer" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="is_correct" class="form-label">Is Correct?</label>
                <select name="is_correct" id="is_correct" class="form-select" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('quiz_answers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
