@extends('layouts.admin')

@section('title', 'Create Module')

@section('content')
    <div class="my-4">
        <h1>Create Module</h1>
        <form action="{{ route('modules.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="course_id" class="form-label">Course</label>
                <select name="course_id" id="course_id" class="form-select" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('modules.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
