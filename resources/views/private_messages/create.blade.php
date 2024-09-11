@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Send a New Message</h1>
    <form action="{{ route('private_messages.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="receiver_id" class="form-label">Receiver</label>
            <select id="receiver_id" name="receiver_id" class="form-select" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</div>
@endsection
