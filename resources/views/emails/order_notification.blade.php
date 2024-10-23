<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        h1 {
            color: #333;
        }
        .order-details {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Order Notification</h1>
        <p>Dear Admin,</p>
        <p>A new order has been placed. Below are the details:</p>

        <div class="order-details">
            <p><strong>Order ID:</strong> {{ $orderId }}</p>
            <p><strong>Total Amount:</strong> ${{ number_format($orderTotal, 2) }}</p>
        </div>

        <p>Thank you!</p>
        <p>Best Regards,<br>Your Company Name</p>
    </div>
</body>
</html>
