<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Connexion</title>
</head>

<body>

    <div class="login-form">
        <?php
        if (isset($_GET['login_err'])) {
            $err = htmlspecialchars($_GET['login_err']);

            switch ($err) {
                case 'password':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> mot de passe incorrect
                    </div>
                    <?php
                    break;

                case 'email':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> email incorrect
                    </div>
                    <?php
                    break;

                case 'already':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> compte non existant
                    </div>
                    <?php
                    break;
            }
        }
        ?>

        <form action="connexion.php" method="post">
            <h2 class="text-center">Connexion</h2>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required="required"
                    autocomplete="off">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe"
                    required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Connexion</button>
            </div>
        </form>
        <p class="text-center"><a href="inscription.php">Inscription</a></p>
        <p class="text-center"><a href="accueil.php">retour à l'accueil</a></p>
        <img src="images/logoinstanmanga.png" width="25%">
    </div>
    <style>
        body {
            background-color: white;
        }

        .login-form {
            width: 340px;
            margin: 50px auto;
            color: orange;
        }

        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .login-form h2 {
            margin: 0 0 15px;
        }

        .form-control,
        .btn {
            min-height: 38px;
            border-radius: 2px;
        }

        .btn {
            font-size: 20px;
            font-weight: bold;
        }

        img {
            margin-left: 40%;
        }

        input[type="email"]:focus::-webkit-input-placeholder {
            transition: opacity 0.5s ease-in-out;
            opacity: 0;
        }

        input[type="email"]:focus::-moz-placeholder {
            transition: opacity 0.5s ease-in-out;
            opacity: 0;
        }

        input[type="email"]:focus:-ms-input-placeholder {
            transition: opacity 0.5s ease-in-out;
            opacity: 0;
        }

        input[type="email"]:focus {
            transition: color 0.5s ease-in-out;
            font-size: 0.9em;
        }
        input[type="password"]:focus::-webkit-input-placeholder {
            transition: opacity 0.5s ease-in-out;
            opacity: 0;
        }

        input[type="password"]:focus::-moz-placeholder {
            transition: opacity 0.5s ease-in-out;
            opacity: 0;
        }

        input[type="password"]:focus:-ms-input-placeholder {
            transition: opacity 0.5s ease-in-out;
            opacity: 0;
        }

        input[type="password"]:focus {
            transition: color 0.5s ease-in-out;
            font-size: 0.9em;
        }
    </style>
</body>

</html>