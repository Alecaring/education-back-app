@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>All Materials</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('materials.create') }}" class="btn btn-primary mb-3">Upload New Material</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Module</th>
                <th>Description</th>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
                <tr>
                    <td>{{ $material->id }}</td>
                    <td>{{ $material->module->name }}</td>
                    <td>{{ $material->description }}</td>
                    <td>
                        <a href="{{ Storage::url($material->file_url) }}" target="_blank">View File</a>
                    </td>
                    <td>
                        <a href="{{ route('materials.edit', $material) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('materials.destroy', $material) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
