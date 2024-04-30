<!DOCTYPE html>
<html>
<head>
    <title>Your Application Has Been Submitted</title>
</head>
<body>
    <p>Hello, {{ $application->user->name }},</p>
    <p>We have received your application for {{ $application->type }} LEAVE from {{date('d M, Y', strtotime($application->start_date)) }} to {{ date('d M, Y', strtotime($application->end_date)) }}. Our administrative team will review it and get back to you shortly.</p>
    <p>Thank you!</p>
</body>
</html>