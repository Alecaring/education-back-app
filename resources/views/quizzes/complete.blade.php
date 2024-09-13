<!-- resources/views/quizzes/complete.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Completa il Quiz</title>
</head>
<body>
    <h1>Completa il Quiz</h1>
    <form method="POST" action="{{ route('quizzes.complete', ['quizId' => $quiz->id]) }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        @foreach ($quiz->questions as $question)
            <div>
                <label>{{ $question->text }}</label>
                @foreach ($question->answers as $answer)
                    <div>
                        <input type="checkbox" name="answers[{{ $question->id }}][{{ $answer->id }}]" value="{{ $answer->id }}">
                        {{ $answer->text }}
                    </div>
                @endforeach
            </div>
        @endforeach
        <button type="submit">Invia Risposte</button>
    </form>
</body>
</html>
