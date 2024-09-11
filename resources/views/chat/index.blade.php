
@extends('layouts.admin')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        header {
            background: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 2rem;
        }

        .discussion-form,
        .message-form {
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }

        .discussion-form input,
        .message-form input {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .discussion-form button,
        .message-form button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background: #5cb85c;
            color: #fff;
            cursor: pointer;
            font-size: 1rem;
        }

        .discussion-form button:hover,
        .message-form button:hover {
            background: #4cae4c;
        }

        .discussion {
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }

        .discussion h2 {
            margin-top: 0;
            font-size: 1.5rem;
            color: #333;
        }

        .messages {
            margin-top: 10px;
        }

        .messages ul {
            list-style: none;
            padding: 0;
        }

        .messages li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .messages li:last-child {
            border-bottom: none;
        }
    </style>
    
    <header>
        <h1>Chat Application</h1>
    </header>

    <div class="container">
        <div class="discussion-form">
            <form action="{{ route('chat.discussion.store') }}" method="POST">
                @csrf
                <input type="text" name="title" placeholder="Discussion Title" required>
                <button type="submit">Create Discussion</button>
            </form>
        </div>

        @foreach($discussions as $discussion)
            <div class="discussion">
                <h2>{{ $discussion->title }}</h2>

                <div class="message-form">
                    <form action="{{ route('chat.message.store', $discussion->id) }}" method="POST">
                        @csrf
                        <input type="text" name="message" placeholder="Your message" required>
                        <button type="submit">Send Message</button>
                    </form>
                </div>

                <div class="messages">
                    <ul>
                        @foreach($discussion->messages as $message)
                            <li><strong>{{ $message->user->name }}:</strong> {{ $message->message }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>

    @endsection
