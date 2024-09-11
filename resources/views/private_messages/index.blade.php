@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Private Chat</h1>

    <div class="row">
        <!-- Chat Messages -->
        <div class="col-md-8">
            <div class="chat-box border p-3" style="height: 400px; overflow-y: scroll;">
                @foreach($messages as $message)
                    <div class="message">
                        <strong>{{ $message->sender->name }}:</strong>
                        <p>{{ $message->message }}</p>
                        <small class="text-muted">{{ $message->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Send Message -->
        <div class="col-md-4">
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
    </div>
</div>
@endsection
