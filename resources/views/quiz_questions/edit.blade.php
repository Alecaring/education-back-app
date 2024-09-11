@extends('layouts.admin')

@section('title', 'Edit Question')

@section('content')
    <div class="my-4">
        <h1>Edit Question</h1>
        <form action="{{ route('quiz_questions.update', $quizQuestion->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="quiz_id" class="form-label">Quiz</label>
                <select name="quiz_id" id="quiz_id" class="form-select" required>
                    @foreach($quizzes as $quiz)
                        <option value="{{ $quiz->id }}" {{ $quizQuestion->quiz_id == $quiz->id ? 'selected' : '' }}>
                            {{ $quiz->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="question" class="form-label">Question</label>
                <textarea name="question" id="question" class="form-control" rows="3" required>{{ $quizQuestion->question }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('quiz_questions.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
