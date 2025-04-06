<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera i dati dal form
    $username = $_POST['login-username'];
    $password = $_POST['login-password'];

    // Cerca l'utente nel file
    $file = fopen('users.txt', 'r');
    $found = false;
    while (($line = fgets($file)) !== false) {
        list($stored_username, $stored_password) = explode(':', trim($line));
        if ($username === $stored_username && $password === $stored_password) {
            $found = true;
            break;
        }
    }
    fclose($file);

    if ($found) {
        echo "Login riuscito!";
        // Qui potresti iniziare una sessione per l'utente
        // session_start();
        // $_SESSION['username'] = $username;
    } else {
        echo "Nome utente o password errati!";
    }
}
?>
