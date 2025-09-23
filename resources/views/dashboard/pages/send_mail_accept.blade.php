<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to the Platform</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 30px;">
    <div style="background-color: white; padding: 30px; border-radius: 8px; max-width: 700px; margin: auto;">
        <h2> {{ $data['name'] }} </h2>

        <p>
             {{ $data['message'] ?? 'Your account has been approved.' }}
        </p>

        <div style="margin-top: 20px;">
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Password:</strong> {{ $data['password'] }}</p>
        </div>

        <p style="margin-top: 20px;">{!! nl2br(e($data['footer'] ?? "You can now log in using the above credentials.\n— The Website Team")) !!}</p>

        <div style="margin-top: 30px; font-size: 14px; color: #777;">
            <p>— The Website Team</p>
        </div>
    </div>
</body>
</html>