<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres d'apparences</title>
    <script type="text/javascript" src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js></script>
</head>

<body>
    <header>
        <div class="sidenav">
            <a href="accueil.php"><img src="images/Fleche-gauche.png"></a>
            <br><br><a href="#">Compte</a>
            <br><br><a href="#">Sécurité</a>
            <div class="container2">
                <br><br><a href="apparences.php">Apparences</a>
            </div>
            <br><br><a href="#">Aide</a>
            <br><br><a href="#">Contacts</a>
        </div>
    </header>
    <div class="main-content">
        <h3> Changer en darkmode </h3>
        <label class="switch">
            <input type="checkbox" id="toggleTheme">
            <span class="slider round"></span>
        </label>
    </div>
    <hr />

    <script src="apparences.js"></script>
</body>

</html>
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

    .sidenav img {
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
        margin-left: 400px;
        padding: 1px 16px;
    }

    .container2 {
        background-color: lightgrey;
        padding-bottom: 10%;
    }

    .checkbox {
        display: none;
    }

    .label {
        background: gray;
        display: inline-block;
        height: 80px;
        width: 160px;
        position: relative;
        transition: all .3s;
        border-radius: 60px;
        cursor: pointer;
    }

    .label:after {
        content: "";
        height: 60px;
        width: 60px;
        background: white;
        border-radius: 50%;
        position: absolute;
        top: 10px;
        left: 10px;
        transition: all .3s;
    }

    .checkbox:checked+label:after {
        transform: translateX(80px)
    }

    .checkbox:checked+label {
        background: green;
    }

    .nightmode {
        background-color: #262829;
        color: white;
        transition: 0.4s ease-in-out;
    }

    .daymode {
        background-color: #fff;
        color: black;
        transition: 0.4s ease-in-out;
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