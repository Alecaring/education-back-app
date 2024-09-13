<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>{{ $quiz->title }}</h1>

    <form id="quiz-form" action="{{ route('quizzes.complete', $quiz->id) }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        
        @foreach ($quiz->questions as $question)
            <div>
                <p>{{ $question->text }}</p>
                @foreach ($question->answers as $answer)
                    <div>
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" required>
                        <label>{{ $answer->text }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <button type="submit">Submit Quiz</button>
    </form>
    
    <script>
        document.getElementById('quiz-form').addEventListener('submit', function(event) {
            event.preventDefault();
            
            var formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.points_awarded) {
                    // Handle points display
                    console.log('Points awarded:', data.points_awarded);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
