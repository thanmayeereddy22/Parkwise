<?php
$booking_id = $_GET['booking_id'] ?? null;

if ($booking_id) {
    // Auto-submit form with hidden booking_id
    echo "<form id='paymentForm' action='payment_successful.php' method='POST'>
            <input type='hidden' name='booking_id' value='{$booking_id}'>
          </form>
          <script>
            document.getElementById('paymentForm').submit();
          </script>";
} else {
    // Show QR code to manually pay
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Scan & Pay - ParkWise</title>
        <link rel='stylesheet' href='assets/css/style.css'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #121212;
                color: #ffffff;
                text-align: center;
                padding-top: 50px;
            }
            .qr-container {
                background-color: #1e1e1e;
                border: 1px solid #333;
                border-radius: 12px;
                padding: 30px;
                display: inline-block;
                box-shadow: 0 0 10px rgba(0,0,0,0.5);
            }
            .qr-container img {
                max-width: 250px;
                margin-bottom: 20px;
                border-radius: 8px;
            }
            .note {
                font-size: 0.95em;
                margin-top: 10px;
                color: #bbb;
            }
            .home-link {
                display: inline-block;
                margin-top: 30px;
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                border-radius: 6px;
                text-decoration: none;
                transition: background-color 0.3s;
            }
            .home-link:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class='qr-container'>
            <h2>Scan to Pay</h2>
            <img src='assets/images/qr_gpay.png' alt='UPI QR Code'>
            <p class='note'>Use any UPI app like GPay / PhonePe / PayTM to complete the payment.</p>
        </div>
        <br>
        <a class='home-link' href='dashboard.php'>Back to Homepage</a>
    </body>
    </html>";
}
?>
