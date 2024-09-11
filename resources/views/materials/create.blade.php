@extends('layouts.admin')

@section('content')

<div class="container">
    <h1>Upload New Material</h1>
    <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="module_id" class="form-label">Module</label>
            <select id="module_id" name="module_id" class="form-select" required>
                @foreach($modules as $module)
                    <option value="{{ $module }}">{{ $module->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" id="description" name="description" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">File</label>
            <input type="file" id="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
