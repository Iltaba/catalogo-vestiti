<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera i dati dal form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Controlla se l'utente esiste già
    $file = fopen('users.txt', 'r');
    $exists = false;
    while (($line = fgets($file)) !== false) {
        list($stored_username, $stored_password) = explode(':', trim($line));
        if ($stored_username === $username) {
            $exists = true;
            break;
        }
    }
    fclose($file);

    if ($exists) {
        echo "Nome utente già esistente!";
    } else {
        // Salva i nuovi dati dell'utente nel file
        $file = fopen('users.txt', 'a');  // Apri il file in modalità append
        fwrite($file, "$username:$password\n");
        fclose($file);

        echo "Registrazione completata!";
    }
}
?>

