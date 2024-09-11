@extends('layouts.admin')

@section('title', 'Module Details')

@section('content')
    <div class="my-4">
        <h1>Module Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $module->title }}</h5>
                <p class="card-text"><strong>Course:</strong> {{ $module->course->name }}</p>
                <p class="card-text"><strong>Content:</strong> {{ $module->content }}</p>
                <a href="{{ route('modules.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
