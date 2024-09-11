@extends('layouts.admin')

@section('title', 'Create Certificate')

@section('content')
    <div class="my-4">
        <h1>Create Certificate</h1>
        <form action="{{ route('certificates.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="course_id" class="form-label">Course</label>
                <select name="course_id" id="course_id" class="form-select" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="issued_at" class="form-label">Issued At</label>
                <input type="date" name="issued_at" id="issued_at" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="expires_at" class="form-label">Expires At</label>
                <input type="date" name="expires_at" id="expires_at" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('certificates.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
