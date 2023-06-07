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
}

// Ottieni l'ID di monitoraggio dall'URL
$codiceMonitoraggio = $_GET['id'];

// Salvataggio dell'ora di apertura dell'email sul file di testo
salvaLetturaMonitoraggio($codiceMonitoraggio);

// Ritorna l'immagine nove.jpg
header('Content-Type: image/jpeg');
readfile('nove.jpg');
?>
