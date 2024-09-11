@extends('layouts.admin')

@section('title', 'Edit Certificate')

@section('content')
    <div class="my-4">
        <h1>Edit Certificate</h1>
        <form action="{{ route('certificates.update', $certificate->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $certificate->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="course_id" class="form-label">Course</label>
                <select name="course_id" id="course_id" class="form-select" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $certificate->course_id == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="issued_at" class="form-label">Issued At</label>
                <input type="date" name="issued_at" id="issued_at" class="form-control" value="{{ $certificate->issued_at->format('Y-m-d') }}" required>
            </div>
            <div class="mb-3">
                <label for="expires_at" class="form-label">Expires At</label>
                <input type="date" name="expires_at" id="expires_at" class="form-control" value="{{ $certificate->expires_at->format('Y-m-d') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('certificates.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
