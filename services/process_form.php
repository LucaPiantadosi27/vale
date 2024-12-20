<?php
header('Content-Type: application/json');

// Funzione per validare le email
function is_valid_email($email) {
    // Controlla che l'email sia valida
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    // Lista di domini comuni per email spam o generiche
    $blocked_domains = [
        'example.com',
        'test.com',
        'mailinator.com',
        'tempmail.com',
        'fakeemail.com',
        'yopmail.com',
        '10minutemail.com',
    ];

    // Estrai il dominio dall'email
    $email_domain = substr(strrchr($email, '@'), 1);

    // Controlla se il dominio è nella lista bloccata
    if (in_array($email_domain, $blocked_domains)) {
        return false;
    }

    // Controlla email generiche comunemente usate per spam
    $blocked_emails = [
        'test@test.com',
        'example@example.com',
        'admin@admin.com',
        'user@user.com',
    ];

    if (in_array($email, $blocked_emails)) {
        return false;
    }

    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $cognome = $_POST['cognome'] ?? '';
    $email = $_POST['email'] ?? '';
    $messaggio = $_POST['messaggio'] ?? '';

    // Controlla che tutti i campi siano compilati
    if (empty($nome) || empty($cognome) || empty($email) || empty($messaggio)) {
        echo json_encode(['success' => false, 'message' => 'Tutti i campi sono obbligatori.']);
        exit;
    }

    // Controlla la validità dell'email
    if (!is_valid_email($email)) {
        echo json_encode(['success' => false, 'message' => 'L\'email inserita non è valida o è considerata spam.']);
        exit;
    }

    $to = 'luca.piantadosi@itconsultingsrl.it';
    $subject = 'Nuovo messaggio dal modulo di contatto';
    $body = "Nome: $nome\nCognome: $cognome\nEmail: $email\nMessaggio:\n$messaggio";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Errore nell\'invio della mail.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metodo non supportato.']);
}
?>
