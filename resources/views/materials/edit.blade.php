@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Material</h1>
    <form action="{{ route('materials.update', $material) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="{{ $material->description }}" required>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">File (optional)</label>
            <input type="file" id="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
