<?php
session_start();
require_once 'config.php';


if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}


if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['new_password_retype'])) {
    $current_password = htmlspecialchars($_POST['current_password']);
    $new_password = htmlspecialchars($_POST['new_password']);
    $new_password_retype = htmlspecialchars($_POST['new_password_retype']);

    // On récupère les infos de l'utilisateur
    $check_password = $bdd->prepare('SELECT password FROM utilisateurs WHERE token = :token');
    $check_password->execute(array("token" => $_SESSION['user']));
    $data_password = $check_password->fetch();


    if (password_verify($current_password, $data_password['password'])) {
        if ($new_password === $new_password_retype) {
            $cost = ['cost' => 12];
            $new_password = password_hash($new_password, PASSWORD_BCRYPT, $cost);
            // On met à jour la table utiisateurs
            $update = $bdd->prepare('UPDATE utilisateurs SET password = :password WHERE token = :token');
            $update->execute(array("password" => $new_password,
            "token" => $_SESSION['user']));
            // On redirige
            header('Location: parametres.php?err=success_password');
            die();
        }
    } else {
        header('Location: parametres.php?err=current_password');
        die();
    }

} else {
    header('Location: parametres.php');
    die();
}