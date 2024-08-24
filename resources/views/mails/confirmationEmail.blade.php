<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation and Contract</title>
</head>
<body>
    <p>Hello {{ $applicantName }},</p>
    <p>We are pleased to inform you that your registration for the dormitory has been successfully confirmed.</p>
    <p>Attached to this email, you will find the contract for your dormitory accommodation. Please review it carefully and sign where indicated.</p>
    <p>Additionally, please note that the first payment for your accommodation is due before the last day of {{ $paymentDueDays }}.</p>
    <p>Total Payment Amount: ₱{{ $totalAmount }}</p>
    <p>Items Included in Payment:</p>
    <ul>
        <li>Dormitory Accommodation: ₱2000</li>
        @if($laptopIncluded)
            <li>Laptop: ₱300</li>
        @endif
        @if($electricFanIncluded)
            <li>Electric Fan: ₱300</li>
        @endif
    </ul>
    <p>If you have any questions or concerns regarding the contract or payment, feel free to contact us.</p>
    <p>To complete your registration, please follow these steps:</p>
    <ol>
        <li>Download our application from: [Attached Application Download Link]</li>
        <li>Alternatively, visit our website at [Website Link] and log in to your account.</li>
        <li>Submit your payment receipt through your account if payment is done.</li>
    </ol>
    <p>Thank you for choosing our dormitory. We look forward to welcoming you soon!</p>
    <p>Best regards,</p>
    <p>The Dormitory Management Team</p>
</body>
</html>
