<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Rewards</title>
</head>
<body>
    <h1>Available Rewards</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Reward Name</th>
                <th>Points Required</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rewards as $reward)
                <tr>
                    <td>{{ $reward->name }}</td>
                    <td>{{ $reward->points_required }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <a href="{{ route('rewards.check', ['userId' => auth()->user()->id]) }}">Check My Rewards</a>
</body>
</html>
