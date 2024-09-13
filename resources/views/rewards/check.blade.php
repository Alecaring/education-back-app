<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Rewards</title>
</head>
<body>
    <h1>Check Your Rewards</h1>

    <p>Total Points: {{ $userPoints }}</p>

    @if ($rewards->isEmpty())
        <p>No rewards available for your points.</p>
    @else
        <ul>
            @foreach ($rewards as $reward)
                <li>
                    {{ $reward->name }} - {{ $reward->points_required }} points
                    <form action="{{ route('rewards.redeem') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="reward_id" value="{{ $reward->id }}">
                        <button type="submit">Redeem</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('rewards.index') }}">Back to Rewards List</a>
</body>
</html>
