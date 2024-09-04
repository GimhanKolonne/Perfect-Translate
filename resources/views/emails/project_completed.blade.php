<!DOCTYPE html>
<html>
<head>
    <title>Project Completed</title>
</head>
<body>
<h1>The project is completed</h1>
<p>Dear {{ $project->user->name }},</p>
<p>The project "{{ $project->project_name }}" has been completed. Good job in completing the project.</p>
<p>Thank you for your hardwork!</p>
</body>
</html>
