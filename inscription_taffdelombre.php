<?php 
    require_once 'config.php'; 

    
    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']))
    {
        
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);

        // On vérifie si l'utilisateur existe
        $check = $bdd->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        $email = strtolower($email); // je te passe en miniscule frérot dsl
        
        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
        if($row == 0){ 
            if(strlen($pseudo) <= 100){ 
                if(strlen($email) <= 100){ 
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){ 
                        if($password === $password_retype){ 

                            
                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                            
                            // On stock l'IP mastock
                            $ip = $_SERVER['REMOTE_ADDR']; 
                            
                            // On insère dans la base de données
                            $insert = $bdd->prepare('INSERT INTO utilisateurs(pseudo, email, password, ip, token) VALUES(:pseudo, :email, :password, :ip, :token)');
                            $insert->execute(array(
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password,
                                'ip' => $ip,
                                'token' => bin2hex(openssl_random_pseudo_bytes(64))
                            ));
                            // redirection avec le message de succès ggez
                            header('Location:inscription.php?reg_err=success');
                            die();
                            // ou fail...
                        }else{ header('Location: inscription.php?reg_err=password'); die();}
                    }else{ header('Location: inscription.php?reg_err=email'); die();}
                }else{ header('Location: inscription.php?reg_err=email_length'); die();}
            }else{ header('Location: inscription.php?reg_err=pseudo_length'); die();}
        }else{ header('Location: inscription.php?reg_err=already'); die();}
    }