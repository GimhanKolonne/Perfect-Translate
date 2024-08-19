<!DOCTYPE html>
<html>
<head>
    <title>Application Accepted</title>
</head>
<body>
<h1>Your Application Has Been Accepted</h1>
<p>Dear {{ $application->translator->user->name }},</p>
<p>Your application for the project "{{ $project->project_name }}" has been accepted. The project is now in progress.</p>
<p>Thank you for your application!</p>
</body>
</html>
