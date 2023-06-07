<?php
function salvaLetturaMonitoraggio($codiceMonitoraggio) {
    // Percorso del file di testo per il salvataggio dell'ora di lettura
    $percorsoFile = 'ore.txt';

    // Formatta l'ora di lettura
    $oraLettura = date('Y-m-d H:i:s');

    // Creazione della riga da salvare sul file
    $riga = $codiceMonitoraggio . '|' . $oraLettura . PHP_EOL;

    // Aggiunta della riga al file di testo
    file_put_contents($percorsoFile, $riga, FILE_APPEND);

    // Invia una seconda email di conferma
    inviaEmailConferma($codiceMonitoraggio);
}

function inviaEmailConferma($codiceMonitoraggio) {
    // Percorso del file di testo per il recupero dell'email corrispondente al codice di monitoraggio
    $percorsoFile = 'ore.txt';

    // Legge il file di testo
    $contenuto = file_get_contents($percorsoFile);

    // Cerca il codice di monitoraggio e l'email corrispondente
    $righe = explode(PHP_EOL, $contenuto);
    foreach ($righe as $riga) {
        $rigaSeparata = explode('|', $riga);
        if ($rigaSeparata[0] == $codiceMonitoraggio) {
            $destinatario = $rigaSeparata[1];
            break;
        }
    }

    // Verifica se è stata trovata una corrispondenza
    if (isset($destinatario)) {
        // Parametri email
        $oggetto = 'Grazie per aver aperto la mail precedente!';
        $messaggio = 'Gentile destinatario,

    Grazie per aver aperto la mail precedente.

    Cordiali saluti,
    Il tuo nome';

        // Intestazioni dell'email
        $headers = "From: noreply@example.com\r\n";
        $headers .= "Reply-To: noreply@example.com\r\n";
        $headers .= "Cc: noreply@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

        // Invio dell'email utilizzando la funzione mail() di PHP
        mail($destinatario, $oggetto, $messaggio, $headers);
    }
}

// Ottieni l'ID di monitoraggio dall'URL
$codiceMonitoraggio = $_GET['id'];

// Salvataggio dell'ora di apertura dell'email sul file di testo e invio dell'email di conferma
salvaLetturaMonitoraggio($codiceMonitoraggio);

// Ritorna l'immagine nove.jpg
header('Content-Type: image/jpeg');
readfile('nove.jpg');
?>
