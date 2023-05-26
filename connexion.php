<?php 
    session_start(); // Hop la on démarre la session
    require_once 'config.php'; // On inclut la connexion à la BDD :x

    if(!empty($_POST['email']) && !empty($_POST['password'])) 
    {
        
        $email = htmlspecialchars($_POST['email']); 
        $password = htmlspecialchars($_POST['password']);
        
        $email = strtolower($email); // mets toi en MINISCULES !
        
        // Check de l'utilisateurs XD
        $check = $bdd->prepare('SELECT pseudo, email, password, token FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();
        
        

        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
            // vérifie le bon format
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                // Si le mot de passe est le bon
                if(password_verify($password, $data['password']))
                {
                    // On créer la session et on redirige sur parametres.php
                    $_SESSION['user'] = $data['token'];
                    $_SESSION['id_utilisateurs'] = $data['id_utilisateurs'];
                    header('Location: parametres.php');
                    die();
                }else{ header('Location: index.php?login_err=password'); die(); }
            }else{ header('Location: index.php?login_err=email'); die(); }
        }else{ header('Location: index.php?login_err=already'); die(); }
    }else{ header('Location: index.php'); die();} 