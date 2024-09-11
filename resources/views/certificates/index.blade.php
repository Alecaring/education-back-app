@extends('layouts.admin')

@section('title', 'Certificates')

@section('content')
    <div class="my-4">
        <h1>Certificates</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('certificates.create') }}" class="btn btn-primary mb-3">Create New Certificate</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Course</th>
                    <th>Issued At</th>
                    <th>Expires At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($certificates as $certificate)
                    <tr>
                        <td>{{ $certificate->user->name }}</td>
                        <td>{{ $certificate->course->name }}</td>
                        <td>{{ $certificate->issued_at ? $certificate->issued_at->format('Y-m-d') : 'N/A' }}</td>
                        <td>{{ $certificate->expires_at ? $certificate->expires_at->format('Y-m-d') : 'N/A' }}</td>
                                                <td>
                            <a href="{{ route('certificates.show', $certificate->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('certificates.edit', $certificate->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('certificates.destroy', $certificate->id) }}" method="POST" style="display:inline;">
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
