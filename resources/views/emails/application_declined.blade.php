<!DOCTYPE html>
<html>
<head>
    <title>Application Declined</title>
</head>
<body>
<h1>Your Application Has Been Declined</h1>
<p>Dear {{ $application->translator->user->name }},</p>
<p>We regret to inform you that your application for the project "{{ $application->project->project_name }}" has been declined.</p>
<p>Thank you for your interest and effort.</p>
</body>
</html>
