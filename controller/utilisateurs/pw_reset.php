Controller utilisateur PW_RESET |

<?php

// On supprime le mot de passe en BDD

// On créé un token
if (isset($_GET['id'])) {
    if (fetch_user_by_id($pdo, $_GET['id'])) {
        $token = md5(time());
        // On associe le token à l'utilisateur
        $data = [
            'token' => $token,
            'id' => $_GET['id']
        ];
        users_update($pdo, $data);
        $_SESSION['msg'] = [
            'css' => 'success',
            'txt' => 'Token enregistré'
        ];
    } else {
        $_SESSION['msg'] = [
            'css' => 'warning',
            'txt' => 'Utilisateur introuvable'
        ];
        header('Location: index.php?controller=utilisateurs&action=list');
        exit;
    }
} else {
    $_SESSION['msg'] = [
        'css' => 'warning',
        'txt' => 'Adresse email manquante'
    ];
    header('Location: index.php?controller=utilisateurs&action=list');
    exit;
}


// On envoie un email à l'utilisateur pour lui transmettre le token
require_once ROOT . '/model/mail.php';

if (fetch_user_by_id($pdo, $_GET['id'])) {
    $utilisateur = fetch_user_by_id($pdo, $_GET['id']);
}

try {
    //Server settings
    $mail->isSMTP();                                    //Send using SMTP
    $mail->Host       = $config['smtp']['host'];        //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                           //Enable SMTP authentication
    $mail->Username   = $config['smtp']['username'];    //SMTP username
    $mail->Password   = $config['smtp']['password'];    //SMTP password
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;    //Enable implicit TLS encryption
    $mail->Port       = $config['smtp']['port'];        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($config['smtp']['username'], 'Message serveur');
    $mail->addAddress($utilisateur['mail']);       //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Réinitialisation de votre mot de passe';
    $mail->Body    = 'Vous avez demander la réintialisation de votre mot de passe.<br> Pour poursuivre veuillez sur le lien suivant :<br><a href="http://localhost/citations/controller/utilisateurs/pw_reset.php?token=' . $token . '">Réinitialiser votre mot de passe</a>';
    $mail->AltBody = 'Vous avez demander la réintialisation de votre mot de passe.\nl Pour poursuivre veuillez vous rendre à l\'adresse suivante :\nl http://localhost/citations/controller/utilisateurs/pw_reset.php?token=' . $token .'';

    $mail->send();
    echo 'Message envoyé';
} catch (Exception $e) {
    echo "Le message n'a pu être envoyé. Mailer Error: {$mail->ErrorInfo}";
}
