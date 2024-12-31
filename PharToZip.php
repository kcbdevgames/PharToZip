<?php
function convertPharToZip($pharPath, $zipPath) {
    try {
        if (!file_exists($pharPath)) {
            throw new Exception("Die Phar-Datei existiert nicht.");
        }

        // Phar in eine ZIP-Datei konvertieren
        $phar = new Phar($pharPath);
        $phar->convertToData(Phar::ZIP)->compress(Phar::GZ);
        copy($pharPath . '.zip', $zipPath);
        unlink($pharPath . '.zip');
        echo "Phar-Datei wurde erfolgreich in eine ZIP-Datei konvertiert: $zipPath\n";
    } catch (Exception $e) {
        echo "Fehler: " . $e->getMessage() . "\n";
    }
}

function convertZipToPhar($zipPath, $pharPath) {
    try {
        if (!file_exists($zipPath)) {
            throw new Exception("Die ZIP-Datei existiert nicht.");
        }

        // ZIP in eine Phar-Datei konvertieren
        $phar = new Phar($pharPath);
        $phar->buildFromDirectory(dirname($zipPath));
        echo "ZIP-Datei wurde erfolgreich in eine Phar-Datei konvertiert: $pharPath\n";
    } catch (Exception $e) {
        echo "Fehler: " . $e->getMessage() . "\n";
    }
}

// Beispielnutzung
$pharFile = 'example.phar';
$zipFile = 'example.zip';

// Phar in ZIP umwandeln
convertPharToZip($pharFile, $zipFile);

// ZIP in Phar umwandeln
convertZipToPhar($zipFile, $pharFile);
?>
