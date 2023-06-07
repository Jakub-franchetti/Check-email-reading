<!DOCTYPE html>
<html>
<head>
    <title>Email Form</title>
</head>
<body>
    <form method="post" >
        <label for="email">Recipient Email:</label>
        <input type="email" id="email" name="email" required value="@gmail.com">
        <button type="submit" name="send">Send Email</button>
    </form>
</body>
</html>
<?php
if(isset($_POST['send'])){
    // Email parameters
    $recipient = $_POST['email'];
    $subject = 'Email Subject';
    $message = 'Email Body';

    $trackingCode = uniqid();

    // Tracking image URL
    $trackingImageUrl = 'https://www.example.com/InnocuousSite/sus2/track.php?id=' . $trackingCode;

    // Tracking image HTML code
    $trackingImage = '<img src="' . $trackingImageUrl . '" alt="" />';

    // Add tracking image to email body
    $message .= $trackingImage;

    // Email headers
    $headers = "From: noreply@gmail.com\r\n";
    $headers .= "Reply-To: noreply@gmail.com\r\n";
    $headers .= "Cc: noreply@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    // Save tracking code and email to ore.txt
    saveTrackingCodeEmail($trackingCode, $recipient);

    // Send the email
    if (mail($recipient, $subject, $message, $headers)) {
        echo 'Email sent successfully to '.$recipient;
    } else {
        echo 'An error occurred while sending the email.';
    }
}

function saveTrackingCodeEmail($trackingCode, $email) {
    // File path for saving the tracking code and email
    $filePath = 'ore.txt';

    // Create the line to be saved in the file
    $line = $trackingCode . '|' . $email . PHP_EOL;

    // Append the line to the text file
    file_put_contents($filePath, $line, FILE_APPEND);
}
?>

