<?php

//Gère le site pour un visiteur non connecté

//JSON pour l'API
if (isset($_GET['json'])) {
    $datas = getAllLocations($db);
    if (!is_string($datas)) {
        echo json_encode($datas);
    }
    exit();
}

// Si on essaie de se connecter

if (isset($_GET['connect'])) {

    // si le formulaire a été envoyé
    if (isset($_POST['username'], $_POST['passwd'])) {
        // protection du champs qui sera dans la requête
        $username = htmlspecialchars(strip_tags(trim($_POST['username'])), ENT_QUOTES);
        // protection pour les espaces vide
        $userpwd = trim($_POST['passwd']);
        //tentative de connexion
        $connect = connectAdministrator($db, $username, $userpwd);
        //Connexion réussie
        if ($connect === true) {
            header("Location: ./");
            exit();
        } else {
            $error = "Login et/ou mot de passe incorrect";
        }
    }
    //Appel de la vue
    include "../view/public/connect.view.html.php";
    exit();
}