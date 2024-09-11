@extends('layouts.admin')

@section('title', 'Certificate Details')

@section('content')
    <div class="my-4">
        <h1>Certificate Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $certificate->course->name }}</h5>
                <p class="card-text">Issued to: {{ $certificate->user->name }}</p>
                <p class="card-text">Issued at: {{ $certificate->issued_at->format('Y-m-d') }}</p>
                <p class="card-text">Expires at: {{ $certificate->expires_at->format('Y-m-d') }}</p>
                <a href="{{ route('certificates.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
