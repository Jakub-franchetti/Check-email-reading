<?php
// Parametri email
$destinatario = 'recipient email';
$oggetto = 'Oggetto dell\'email';
$messaggio = 'Corpo dell\'email';

$codiceMonitoraggio = uniqid();

// URL dell'immagine di monitoraggio
$urlMonitoraggio = 'https://www.wosknet.com/SitoInnocuo/sus2/track.php?id=' . $codiceMonitoraggio;

// Codice HTML dell'immagine di monitoraggio
$immagineMonitoraggio = '<img src="' . $urlMonitoraggio . '" alt="" />';

// Aggiungi l'immagine di monitoraggio al corpo dell'email
$messaggio .= $immagineMonitoraggio;

// Intestazioni dell'email
//$message = "Questa mail è stata inviata perchè è stata visualizzata l'immagine all'indirizzo: <a href='https://www.ricecipriani.it/img.svg.php'>smile.svg</a>";

 $headers = "From: noreply@gmail.com\r\n";
 $headers = "Reply-To: noreply@gmail.com\r\n";
 $headers .= "Cc: noreply@gmail.com\r\n";
 $headers = "MIME-Version: 1.0\r\n";
 $headers = "Content-Type: text/html; charset=utf-8\r\n";

 // Invio dell'email utilizzando la funzione mail() di PHP
 $mailSent = mail($to, $subject, $message, $headers);

// Invia l'email
if (mail($destinatario, $oggetto, $messaggio, $headers)) {
    // Salvataggio del codice di monitoraggio su un file di testo
    salvaCodiceMonitoraggio($codiceMonitoraggio);
    echo 'Email inviata con successo.';
} else {
    echo 'Si è verificato un errore durante l\'invio dell\'email.';
}

function salvaCodiceMonitoraggio($codiceMonitoraggio) {
    // Percorso del file di testo per il salvataggio del codice di monitoraggio
    $percorsoFile = 'ore.txt';
    
    // Aggiunta del codice di monitoraggio al file di testo
    file_put_contents($percorsoFile, $codiceMonitoraggio . PHP_EOL, FILE_APPEND);
}
?>
