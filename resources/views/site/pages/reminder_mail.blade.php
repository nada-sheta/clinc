<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Reminder</title>
</head>
<body>
    <h2>Hi {{ $booking->name }} 👋</h2>
    <p>This is a reminder of your reservation appointment:</p>

    <ul>
        <li><strong>Doctor:</strong> {{ $booking->doctor->name }}</li>
        <li><strong>Date and time:</strong> {{ $booking->booking_date->format('Y-m-d H:i') }}</li>
    </ul>

    <p>See you soon!<br>
    {{ config('app.name') }}</p>
</body>
</html>
