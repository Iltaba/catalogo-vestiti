<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera i dati dal form
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Aggiungi qui la logica per convalidare e salvare i dati (ad esempio, nel database)
    // Ad esempio, verifica che le password corrispondano
    if ($password === $confirmPassword) {
        // Crittografa la password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Connetti al database (configura il database e usa il tuo codice di connessione)
        // Assicurati di proteggere il tuo database con prepared statements per evitare SQL Injection

        $conn = new mysqli("localhost", "root", "", "nome_database");
        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }

        // Prepariamo e eseguiamo la query
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, username, dob, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $fullName, $email, $phone, $username, $dob, $hashedPassword);

        if ($stmt->execute()) {
            echo "Registrazione completata con successo!";
        } else {
            echo "Errore durante la registrazione: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Le password non corrispondono.";
    }
}
?>
