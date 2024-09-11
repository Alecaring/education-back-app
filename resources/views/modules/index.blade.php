@extends('layouts.admin')

@section('title', 'Modules')

@section('content')
    <div class="my-4">
        <h1>Modules</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('modules.create') }}" class="btn btn-primary mb-3">Create New Module</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modules as $module)
                    <tr>
                        <td>{{ $module->title }}</td>
                        <td>{{ $module->course->name }}</td>
                        <td>
                            <a href="{{ route('modules.show', $module->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('modules.destroy', $module->id) }}" method="POST" style="display:inline;">
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
