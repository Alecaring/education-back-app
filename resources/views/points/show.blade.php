<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Points</title>
</head>
<body>
    <h1>User Points</h1>

    @if (isset($message))
        <p>{{ $message }}</p>
    @else
        <p>Total Points: {{ $points->points_gained }}</p>
    @endif

    <a href="{{ route('rewards.index') }}">View Rewards</a>
</body>
</html>
