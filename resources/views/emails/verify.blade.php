<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Email Address</title>
</head>
<body>
    <h1>Welcome, {{ $user->full_name }}!</h1>
    <p>Please click the link below to verify your email address:</p>
    <a href="{{ $verificationUrl }}">Verify Email Address</a>
</body>
</html>