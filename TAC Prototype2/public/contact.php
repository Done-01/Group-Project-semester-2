<?php
require_once '../includes/functions_view.php';
require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php renderNavbar($pdo, 'contact'); ?>

    <div class="content-container">
        <h2>Contact Us</h2>
        <p>If you have any questions or need assistance, feel free to reach out to us using the information below:</p>

        <div class="contact-details">
            <div class="contact-method">
                <h3><i class="icon-phone"></i> Phone</h3>
                <p>Customer Service: 020 7946 0958</p>
                <p>24/7 Support Line: 0800 112 3581</p>
                <p>International: +44 20 7946 0958</p>
            </div>

            <div class="contact-method">
                <h3><i class="icon-email"></i> Email</h3>
                <p>General Enquiries: <a href="mailto:info@securebankuk.com">info@securebankuk.com</a></p>
                <p>Support: <a href="mailto:support@securebankuk.com">support@securebankuk.com</a></p>
                <p>Fraud Reporting: <a href="mailto:fraud@securebankuk.com">fraud@securebankuk.com</a></p>
            </div>

            <div class="contact-method">
                <h3><i class="icon-address"></i> Postal Address</h3>
                <p>SecureBank UK PLC</p>
                <p>Customer Services Department</p>
                <p>123 Threadneedle Street</p>
                <p>London, EC2R 8AH</p>
                <p>United Kingdom</p>
            </div>

            <div class="contact-method">
                <h3><i class="icon-hours"></i> Opening Hours</h3>
                <p>Monday-Friday: 8:00am - 8:00pm</p>
                <p>Saturday: 9:00am - 5:00pm</p>
                <p>Sunday: 10:00am - 4:00pm</p>
                <p>24/7 telephone banking available</p>
            </div>
        </div>
    </div>
</body>
</html>