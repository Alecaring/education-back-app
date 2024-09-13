<!DOCTYPE html>
<html>
<head>
    <title>Your Points</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Your Points</h1>
    <p>Total Points: {{ $totalPoints }}</p>
    <h2>Available Rewards</h2>
    <ul>
        @foreach ($rewards as $reward)
            <li>
                {{ $reward->name }} - {{ $reward->points_required }} points
                @if ($totalPoints >= $reward->points_required)
                    <a href="{{ route('rewards.redeem', $reward->id) }}">Redeem</a>
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>
