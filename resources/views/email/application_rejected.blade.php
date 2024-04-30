<!DOCTYPE html>
<html>
<head>
    <title>Your Application Has Been Rejected</title>
</head>
<body>
    <p>Hello, {{ $application->user->name }},</p>
    <p>We regret to inform you that your application for {{ $application->type }} LEAVE from {{date('d M, Y', strtotime($application->start_date)) }} to {{ date('d M, Y', strtotime($application->end_date)) }} has been rejected.</p>
    <p>Reason for rejection: {{ $application->comment }}</p>
    <p>Thank you.</p>
</body>
</html>