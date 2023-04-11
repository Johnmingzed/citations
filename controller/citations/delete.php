<?php

/**
 * supprime une citation par son ID
 */

if (isset($_GET['id'])) {
    delete($pdo, $_GET['id']);
}

header('Location: index.php?controller=citations&action=list');
