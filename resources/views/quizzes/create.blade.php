<!DOCTYPE html>
<html>
<head>
    <title>Create Quiz</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Create New Quiz</h1>
    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf
        <div>
            <label for="module_id">Module</label>
            <select name="module_id" id="module_id" required>
                @foreach ($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
        </div>
        <button type="submit">Create Quiz</button>
    </form>
</body>
</html>
