<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>{{ $messenger }}</h3>
    <form action="{{ route('auth.resetpassword') }}" method="GET">
        <input type="text" style="display: none;" name='email' value='{{ $email }}'>
        <input type="text" style="display: none;" name='token' value='{{ $token }}'>
        <button class="btn btn-primary mb-3">Go</button>
    </form>
</body>

</html>
