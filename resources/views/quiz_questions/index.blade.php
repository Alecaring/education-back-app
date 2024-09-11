@extends('layouts.admin')

@section('title', 'Quiz Questions')

@section('content')
    <div class="my-4">
        <h1>Quiz Questions</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('quiz_questions.create') }}" class="btn btn-primary mb-3">Create New Question</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Quiz</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td>{{ $question->question }}</td>
                        <td>{{ $question->quiz->title }}</td>
                        <td>
                            <a href="{{ route('quiz_questions.show', $question->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('quiz_questions.edit', $question->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('quiz_questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
