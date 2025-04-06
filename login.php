<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera i dati dal form
    $username = $_POST['login-username'];
    $password = $_POST['login-password'];

    // Connetti al database (configura il database e usa il tuo codice di connessione)
    $conn = new mysqli("localhost", "root", "", "nome_database");

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Cerca l'utente nel database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifica la password
        if (password_verify($password, $user['password'])) {
            // Logga l'utente (usa sessioni o cookie per tracciare l'utente)
            session_start();
            $_SESSION['user'] = $user['id'];
            echo "Accesso avvenuto con successo!";
        } else {
            echo "Nome utente o password errati.";
        }
    } else {
        echo "Nome utente non trovato.";
    }

    $stmt->close();
    $conn->close();
}
?>
