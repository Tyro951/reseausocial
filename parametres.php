<?php
session_start();
require_once 'config.php'; // ajout connexion bdd 
// si la session existe pas soit si l'on est pas connecté on redirige
if (!isset($_SESSION['user'])) {
    header('Location:index.php');
    die();
}

$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
$req->execute(array($_SESSION['user']));
$data = $req->fetch();

?>
<!doctype html>
<html lang="en">

<head>  
    <title>paramètres compte</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="sidenav">
            <a href="accueil.php"><img src="images/Fleche-gauche.png"></a>
            <div class="container2">
                <br><br><a href="#">Compte</a>
            </div>
            <br><br><a href="#">Sécurité</a>
            <br><br><a href="apparences.php">Apparences</a>
            <br><br><a href="#">Aide</a>
            <br><br><a href="#">Contacts</a>
        </div>
    </header>
    <div class="main-content">

        <div class="container">
            <div class="col-md-12">
                <?php
                if (isset($_GET['err'])) {
                    $err = htmlspecialchars($_GET['err']);
                    switch ($err) {
                        case 'current_password':
                            echo "<div class='alert alert-danger'>Le mot de passe actuel est incorrect</div>";
                            break;

                        case 'success_password':
                            echo "<div class='alert alert-success'>Le mot de passe a bien été modifié ! </div>";
                            break;
                    }
                }
                ?>


                <div class="text-center">
                    <h1 class="p-5">Vous êtes connectés en tant que :
                        <?php echo $data['pseudo']; ?> 
                    </h1>
                    <hr />
                    <a href="deconnexion.php" class="btn btn-danger btn-lg">Déconnexion</a>
                    <!-- Button trigger modal -->
                    <div class="orange">
                        <br><button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                        data-target="#change_password">
                        Changer mon mot de passe
                    </button></div>
                </div>
            </div>
        </div>
    </div>





    <!-- Modal -->
    <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Changer mon mot de passe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="change_mdp.php" method="POST">
                        <label for='current_password'>Mot de passe actuel</label>
                        <input type="password" id="current_password" name="current_password" class="form-control"
                            required />
                        <br />
                        <label for='new_password'>Nouveau mot de passe</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" required />
                        <br />
                        <label for='new_password_retype'>Re tapez le nouveau mot de passe</label>
                        <input type="password" id="new_password_retype" name="new_password_retype" class="form-control"
                            required />
                        <br />
                        <button type="submit" class="btn btn-success">Sauvegarder</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .sidenav {
            height: 100%;
            width: 20%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            overflow-x: hidden;
        }
        .sidenav img{
            width: 20%;
        }
        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            margin-left: 5%;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .main-content {
            margin-left: 200px;
            padding: 1px 16px;
        }

        .container2 {
            background-color: lightgrey;
            padding-bottom: 10%;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 100%;
            }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>