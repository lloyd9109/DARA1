<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blade Test</title>
</head>
<body>
    <form action="{{ route('send') }}" method="POST">
        @csrf
        <button type="submit">Click Me</button>
    </form>

    <p>
        {{ $greet ?? '' }}
    </p>
</body>
</html>
