@extends('layouts.admin')

@section('title', 'Quiz Answers')

@section('content')
    <div class="my-4">
        <h1>Quiz Answers</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('quiz_answers.create') }}" class="btn btn-primary mb-3">Create New Answer</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Answer</th>
                    <th>Question</th>
                    <th>Correct</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($answers as $answer)
                    <tr>
                        <td>{{ $answer->answer }}</td>
                        <td>{{ $answer->question->question }}</td>
                        <td>{{ $answer->is_correct ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('quiz_answers.show', $answer->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('quiz_answers.edit', $answer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('quiz_answers.destroy', $answer->id) }}" method="POST" style="display:inline;">
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
