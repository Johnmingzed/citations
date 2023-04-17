Controller utilisateur PW_RESET | 

<?php

// On supprime le mot de passe en BDD

// On créé un token
if(isset($_GET['mail']))
// On envoie un email à l'utilisateur pour lui transmettre le token
