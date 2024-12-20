<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recupero dei dati dal form
    $nome = htmlspecialchars(trim($_POST['nome']));
    $cognome = htmlspecialchars(trim($_POST['cognome']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $messaggio = htmlspecialchars(trim($_POST['messaggio']));

    // Controllo dati
    if (!$nome || !$cognome || !$email || !$messaggio) {
        die("Errore: tutti i campi sono obbligatori e devono essere validi.");
    }

    // Destinatario e oggetto
    $to = "luca.piantadosi@itconsultingsrl.it"; // Sostituisci con l'email di destinazione
    $subject = "Nuovo messaggio da $nome $cognome";

    // Corpo dell'email
    $body = "Hai ricevuto un nuovo messaggio:\n\n";
    $body .= "Nome: $nome\n";
    $body .= "Cognome: $cognome\n";
    $body .= "Email: $email\n";
    $body .= "Messaggio:\n$messaggio\n";

    // Header email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Invio dell'email
    if (mail($to, $subject, $body, $headers)) {
        echo "Messaggio inviato con successo.";
    } else {
        echo "Errore nell'invio del messaggio. Verifica la configurazione del server email.";
    }
} else {
    echo "Accesso non autorizzato.";
}
?>
