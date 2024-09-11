@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>{{ $discussion->title }}</h1>

    <div class="chat-box">
        @foreach($discussion->messages as $message)
            <div class="chat-message">
                <strong>{{ $message->user->name }}:</strong> {{ $message->message }}
                <span class="text-muted">({{ $message->created_at->diffForHumans() }})</span>
            </div>
        @endforeach
    </div>

    <form action="{{ route('chat.discussions.storeMessage', $discussion->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <textarea name="message" class="form-control" rows="3" placeholder="Scrivi il tuo messaggio"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Invia</button>
    </form>
</div>
@endsection
