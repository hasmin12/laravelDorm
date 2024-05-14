<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation</title>
</head>
<body>
    <h2>Reservation Confirmation</h2>
    <p>Dear {{ $reservation->name }},</p>
    <p>Your reservation has been successfully created. Below are the details:</p>
    <ul>
        <li>Name: {{ $reservation->name }}</li>
        <li>Email: {{ $reservation->email }}</li>
    </ul>
    <p>Here is your QR code:</p>
    <img src="{{ $message->embed(storage_path('app/' . $reservation->qrcodeImage)) }}" alt="QR Code">

    <p>Please present this QR code during check-in.</p>
    <p>Thank you for choosing our service!</p>
</body>
</html>
