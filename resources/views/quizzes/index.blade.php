@extends('layouts.admin')

@section('content')
    <div>
        <h1>{{ $quiz->title }}</h1>
    </div>

    @foreach ($question as $q)
        <div>
            <h2>{{ $q->question }}</h2>
            <form method="POST" action="{{ route('quizzes.complete', $quiz->id) }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                @foreach ($q->answers as $a)
                    <div>
                        <input type="radio" name="answers[{{ $q->id }}]" value="{{ $a->id }}" required>
                        <label>{{ $a->answer }}</label>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Verifica</button>
            </form>
        </div>
    @endforeach
@endsection
