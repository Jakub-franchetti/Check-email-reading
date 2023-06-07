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
    // Parametri email
    $destinatario = $_POST['email'];
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
    $headers = "From: noreply@gmail.com\r\n";
    $headers .= "Reply-To: noreply@gmail.com\r\n";
    $headers .= "Cc: noreply@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    // Salva il codice di monitoraggio e la mail su ore.txt
    salvaCodiceEmail($codiceMonitoraggio, $destinatario);

    // Invia l'email
    if (mail($destinatario, $oggetto, $messaggio, $headers)) {
        echo 'Email inviata con successo a '.$destinatario;
    } else {
        echo 'Si è verificato un errore durante l\'invio dell\'email.';
    }
}

function salvaCodiceEmail($codiceMonitoraggio, $email) {
    // Percorso del file di testo per il salvataggio del codice di monitoraggio e dell'email
    $percorsoFile = 'ore.txt';

    // Creazione della riga da salvare sul file
    $riga = $codiceMonitoraggio . '|' . $email . PHP_EOL;

    // Aggiunta della riga al file di testo
    file_put_contents($percorsoFile, $riga, FILE_APPEND);
}
?>
