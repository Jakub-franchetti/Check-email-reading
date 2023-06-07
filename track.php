<?php
function saveMonitoringReading($trackingCode) {
    // File path for saving the reading time
    $filePath = 'ore.txt';

    // Format the reading time
    $readingTime = date('Y-m-d H:i:s');

    // Create the line to be saved in the file
    $line = $trackingCode . '|' . $readingTime . PHP_EOL;

    // Append the line to the text file
    file_put_contents($filePath, $line, FILE_APPEND);

    // Send a confirmation email
    sendConfirmationEmail($trackingCode);
}

function sendConfirmationEmail($trackingCode) {
    // File path for retrieving the email corresponding to the tracking code
    $filePath = 'ore.txt';

    // Read the text file
    $content = file_get_contents($filePath);

    // Search for the tracking code and corresponding email
    $lines = explode(PHP_EOL, $content);
    foreach ($lines as $line) {
        $separatedLine = explode('|', $line);
        if ($separatedLine[0] == $trackingCode) {
            $recipient = $separatedLine[1];
            break;
        }
    }

    // Check if a match was found
    if (isset($recipient)) {
        // Email parameters
        $subject = 'Thank you for opening the previous email!';
        $message = 'Dear recipient,

Thank you for opening the previous email.

Best regards,
Your name';

        // Email headers
        $headers = "From: noreply@example.com\r\n";
        $headers .= "Reply-To: noreply@example.com\r\n";
        $headers .= "Cc: noreply@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

        // Send the email using PHP's mail() function
        mail($recipient, $subject, $message, $headers);
    }
}

// Get the tracking ID from the URL
$trackingCode = $_GET['id'];

// Save the email opening time to the text file and send the confirmation email
saveMonitoringReading($trackingCode);

// Return the image nove.jpg
header('Content-Type: image/jpeg');
readfile('nove.jpg');
?>

