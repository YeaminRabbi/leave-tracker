<!DOCTYPE html>
<html>
<head>
    <title>Your Application Has Been Approved</title>
</head>
<body>
    <p>Hello, {{ $application->user->name }},</p>
    <p>We are pleased to inform you that your application for {{ $application->type }} LEAVE has been approved from {{date('d M, Y', strtotime($application->start_date)) }} to {{ date('d M, Y', strtotime($application->end_date)) }}</p>
    <p>Thank you!</p>
</body>
</html>