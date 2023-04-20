<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <?php if (isset($_SESSION['msg'])) : ?>
            <div class="msg">
                <?= $_SESSION['msg']['txt'] ?>
            </div>
        <?php unset($_SESSION['msg']);
        endif ?>

        <h4><?php echo 'Bienvenue ' . $_SESSION['profil']['prenom'] . ($_SESSION['profil']['is_admin'] === 1 ? ' [ADMIN]' : '') . ' !'; ?></h4>

        <nav>
            <ul>
                <li><h3><a href="index.php?controller=citations">Citations</a></h3></li>
                <li><h3><a href="index.php?controller=auteurs">Auteurs</a></h3></li>
            </ul>
            <ul>
                <?php if (isset($_SESSION['profil']['is_admin']) && $_SESSION['profil']['is_admin'] === 1) : ?>
                    <li><h3><a href="index.php?controller=utilisateurs">Utilisateurs</a></h3></li>
                <?php endif ?>
                <li><h3><a href="index.php?controller=profil&action=modifier">Modifiler son profil</a></h3></li>
                <li><h3><a href="index.php?controller=profil&action=deconnexion">Se déconnecter</a></h3></li>

            </ul>
        </nav>
    </header>
    <?= $content; ?>
</body>

</html>