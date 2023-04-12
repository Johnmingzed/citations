<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>

<body>
    <?php if (isset($_SESSION['msg'])) : ?>
        <div class="msg">
            <?= $_SESSION['msg']['txt'] ?>
        </div>
    <?php unset($_SESSION['msg']);
    endif ?>

    <?= 'Bienvenue ' . $_SESSION['profil']['prenom']; ?>
    <nav>
        <ul>
            <li><a href="index.php?controller=citations">Citations</a></li>
            <li><a href="index.php?controller=auteurs">Auteurs</a></li>
        </ul>
        <ul>
            <?php if(isset($_SESSION['profil']['is_admin']) && $_SESSION['profil']['is_admin'] === 1) : ?>
            <li><a href="index.php?controller=utilisateurs">Utilisateurs</a></li>
            <?php endif ?>
            <li><a href="index.php?controller=profil&action=modifier">Modifiler son profil</a></li>
            <li><a href="index.php?controller=profil&action=deconnexion">Se déconnecter</a></li>

        </ul>
    </nav>
    <?= $content; ?>
</body>

</html>