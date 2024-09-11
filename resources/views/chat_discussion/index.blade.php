@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Chat Discussions</h1>

        <div class="chat-box">
            @foreach ($discussions as $discussion)
                <h2>{{ $discussion->title }}</h2>
                @foreach ($discussion->messages as $message)
                    <div class="chat-message">
                        <strong>{{ $message->user->name }}:</strong> {{ $message->message }}
                        <span class="text-muted">({{ $message->created_at->diffForHumans() }})</span>
                    </div>
                @endforeach
            @endforeach
        </div>

        <form action="{{ route('chat.store', ['discussionId' => $discussionId]) }}" method="POST">
            @csrf
            <input type="hidden" name="discussionId" value="{{ $discussionId }}">
            <textarea name="message" class="form-control" rows="3" placeholder="Scrivi il tuo messaggio"></textarea>
            <button type="submit" class="btn btn-primary mt-2">Invia</button>
        </form>

    </div>

    <style>
        .chat-box {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
        }
    </style>
@endsection
