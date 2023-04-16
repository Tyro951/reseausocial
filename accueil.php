<?php
$bdd = new PDO("mysql:host=localhost;dbname=social_network;charset=utf8", "root", "");
if (isset($_POST['supprimertweet'])) {
  $message_id = $_POST['message_id'];

  // Supprimer le message de la base de données
  $req = $bdd->prepare('DELETE FROM tweets WHERE id = ? ');
  $req->execute(array($message_id));

  // Rediriger vers la page précédente
  header('Location: ' . $_SERVER['HTTP_REFERER']);

}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Instanmanga</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="swipe-menu.js" async></script> <!--exécuter les scripts de façon asynchrone.-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/30e89f8594.js" crossorigin="anonymous"></script>
  <script src="systemedelike.js"></script>
</head>

<body>
  <header>
    <div class="header-container">
      <img src="images/logoinstanmanga.png" alt="Logo">
      <form action="" method="get">
        <input type="text" name="motscles" placeholder="Rechercher..." />
        <button type="submit" name="valider">Rechercher</button>
      </form>
      <nav class="nav">
        <ul>
          <li><a href="#" class="onglet">Accueil</a></li>
          <li><a href="#" class="onglet">découvrir</a></li>
          <li><a href="#" class="onglet">messages</a></li>
          <li><a href="#" class="onglet">Notifications</a></li>
          <li><a href="profil.php" class="onglet">profil</a></li>
        </ul>
      </nav>
    </div>
    <nav class="cache" id="menu">
      <ul>
        <li><a href="#">c</a></li>
        <li><a href="#">o</a></li>
        <li><a href="#">o</a></li>
        <li><a href="#">o</a></li>
        <li><a href="profil.html" class="onglet">profil</a></li>
      </ul>
    </nav>
    <div class="cache" id="menuburger">
      <div class="bar1"></div>
      <div class="bar2"></div>
      <div class="bar3"></div>
    </div>
  </header>
  <main>
    <h2 class="filtrez"> RECHERCHEZ PAR THEME : </h2>
      <ul id='destags'>
        <li><button id="animebtn" class="animebtn" data-tag="anime" > ANIME </button></li>
        <li><button id="animebtn" class="animebtn" data-tag="manga" > MANGAS </button></li>
        <li><button id="animebtn" class="animebtn" data-tag="webtoon" > WEBTOONS </button></li>
      </ul>
    <h2 class="tendances"> Tendances du moment : </h2>
    <?php
    session_start();
    $allmsg = $bdd->query('SELECT * FROM tweets ORDER BY id DESC');
    while ($msg = $allmsg->fetch()) { ?>
      <?php
      if (isset($_SESSION['user'])) { ?>
        <div class="card <?php echo $msg['tag']; ?>" id="card">
          <div class="card-body">
            <div class="containerpseudophoto">
              <h5 class="card-title">
                <?php $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
                $req->execute(array($_SESSION['user']));
                $data = $req->fetch();
                echo $data['pseudo']; 
                ?> :
              </h5>
              <div class="trash">
                <button id="monBtn" class="btn" onclick="ouvretoi()"><i class="fa-solid fa-trash"></i></button>
              </div>
              <form action="" method="POST">
                <div class="jetesupprime">
                  <div class="contenu-jetesuppr">
                    <div class="petit-contenu-jetesuppr">
                      <p class="jeteferme">&times;</p>
                      <input type="hidden" name="message_id" value="<?php echo $msg['id']; ?>">
                      <button class="supprime-toi-bien" name="supprimertweet" id="supprime-toi-bien">supprime toi
                        bien</button>
              </form>
              <button class="supprime-toi-pas" id="supprime-toi-pas">supprime toi pas</button>
            </div>
          </div>
        </div>
      </div><br>
        <p class="card-text">
          <?php echo $msg['description']; ?><br>
        </p>
        </div>
        <div class="containerpseudophoto">
          <button id="monBtn" class="btn"><i class="fa-solid fa-heart" id="coeur"></i></button>
          <p id="nombredelikes"> 1971 </p>
          <i class="fa-solid fa-comment" id="commenter"></i>
          <i class="fa-solid fa-share" id="partager"></i>
        </div>
        <p class="card-text"><small class="text-muted">
            <?php echo $msg['date']; ?><br>
          </small></p>
        </div>
        
        <?php
      }?>
      <?php if (!isset($_SESSION['user'])) {
      if(@$afficher == "oui") { ?>
        <div class="card" id="card">
          <div class="card-body">
            <div class="containerpseudophoto">
              <h5 class="card-title">
                adam2 :
              </h5>
              <div class="trash">
                <button id="monBtn" class="btn" ><i class="fa-solid fa-trash"></i></button>
              </div>
              <form action="" method="POST">
                <div class="jetesupprime">
                  <div class="contenu-jetesuppr">
                    <div class="petit-contenu-jetesuppr">
                      <p class="jeteferme">&times;</p>
                      <input type="hidden" name="message_id" value="<?php echo $msg['id']; ?>">
                      <button class="supprime-toi-bien" name="supprimertweet" id="supprime-toi-bien">supprime toi
                        bien</button>
              </form>
              <button class="supprime-toi-pas" id="supprime-toi-pas">supprime toi pas</button>
            </div>
          </div>
        </div>
        </div><br>
        <p class="card-text">
          <?php echo $msg['description']; ?><br>
        </p>
        </div>
        <div class="containerpseudophoto">
          <button id="monBtn" class="btn"><i class="fa-solid fa-heart" id="coeur"></i></button>
          <p id="nombredelikes"> 1971 </p>
          <i class="fa-solid fa-comment" id="commenter"></i>
          <i class="fa-solid fa-share" id="partager"></i>
        </div>
        <p class="card-text"><small class="text-muted">
            <?php echo $msg['date']; ?><br>
          </small></p>
        </div>
        <?php
      }
     } ?>
      <?php
    } ?>
    <div class="cardo">
      <div class="card-body">
        <div class="containerpseudophoto">
          <img src="images/photodeprofiljekiffonepiece.png" alt="jaimeop">
          <h5 class="card-title">JekiffOnePiece</h5>
        </div>
        <p class="card-text">l'épisode 1000 de one piece était vraiment fou un pur chef d'oeuvre !</p>
      </div>
      <img src="images/One-Piece-episode-1000.jpg" class="card-img-bottom" alt="onepiece">
      <div class="containerpseudophoto">
        <button id="monBtn" class="btn" onclick="like()"><i class="fa-solid fa-heart" id="coeur"></i></button>
        <p id="nombredelikes"> 1971 </p>
        <i class="fa-solid fa-comment" id="commenter"></i>
        <i class="fa-solid fa-share" id="partager"></i>
      </div>
      <p class="card-text"><small class="text-muted">posté il y'a 3 minutes</small></p>
    </div>
    <h2 class="conseillez">Ce qui pourrait vous plaires : </h2>
    <div class="cardo">
      <div class="card-body">
        <div class="containerpseudophoto">
          <img src="images/photodeprofiljekiffonepiece.png" alt="jaimeop">
          <h5 class="card-title">JekiffPasOnePiece</h5>
        </div>
        <p class="card-text">l'épisode 1000 de one piece était vraiment une disaster class !</p>
      </div>
      <div class="containerpseudophoto">
        <div class="coeur2ez"><button id="monBtn2" class="btn" onclick="like()"><i class="fa-solid fa-heart"
              id="coeur2"></i></button></div>
        <p class="nombredelikes2" id="nombredelikes2"> 4</p>
        <i class="fa-solid fa-comment" id="commenter2"></i>
        <i class="fa-solid fa-share" id="partager2"></i>
      </div>
      <p class="card-text"><small class="text-muted">posté il y'a 38 minutes</small></p>
    </div>

    <?php if (!isset($_SESSION['user'])) { ?>
    <div class="cotoibatard" id="cotoibatard">
      <div class="contenudecotoibatard" id="contenudecotoibatard">
        <h2> connecte toi le s</h2><br>
        <form action="connexion.php">
          <button class="btn btn-primary" type="submit">
            co toi met toi a l'aise
          </button>
        </form><br>
        <h6> ouuuu </h6><br>
        <form action="inscription.php">
          <button class="btn btn-primary" type="submit">
            rejoins la manga miff!
          </button>
        </form>
      </div>
    </div> <?php } ?>


  </main>
</body>
<script src="filtrage.js"></script>
<script src="supprimerunpost.js"></script>
<script src="inscris-toi.js"></script>
</html>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
  }

  header {
    background-color: #1DA1F2;
    padding: 1.5%;
    display: flex;
    justify-content: space-between;
  }

  .header-container {
    display: flex;
    align-items: center;
    max-width: 100%;
    margin: 0 auto;
  }

  header img {
    width: 5%;
    margin-right: 20px;
  }

  header form {
    display: flex;
    align-items: center;
    background-color: #fff;
    border-radius: 20px;
    padding: 10px;
  }

  header form input[type="text"] {
    border: none;
    outline: none;
    font-size: 14px;
    padding: 10px;
    width: 70%;
  }

  header form button[type="submit"] {
    background-color: orange;
    color: #fff;
    border: none;
    outline: none;
    border-radius: 20px;
    padding: 10px 20px;
    font-size: 14px;
    cursor: pointer;
  }

  header .nav {
    display: flex;
  }

  header .nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
  }

  header .nav ul li {
    margin-left: 35%;
  }

  header .nav ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 100%;
  }

  h2 {
    margin-left: 20%;
  }

  .tendances {
    color: orange;
    margin-top: 2%;
  }

  .conseillez {
    color: orange;
  }

  .containerpseudophoto {
    margin-right: 70%;
    display: flex;
  }

  .image-upload>input {
    display: none;
  }

  .containerpseudophoto h5 {
    margin-top: 3%;
  }

  .trash {
    position: absolute;
    right: 10px;
  }

  .jetesupprime {
    display: none;
    z-index: 1;
    left: 0;
    top: 0;
    margin-left: 20%;
    margin-top: 15%;
    position: fixed;
    width: 50%;
    height: 50%;
    overflow: hidden;
    background-color: orange;
    opacity: 80%;
  }

  .supprime-toi-bien {
    border-radius: 25%;
    background-color: rgb(19, 116, 219);
    color: white;
    margin-left: 10%;
    padding: 2%;
  }

  .supprime-toi-pas {
    border-radius: 25%;
    background-color: rgb(19, 116, 219);
    color: white;
    margin-left: 10%;
    padding: 2%;
  }

  .supprime-toi-bien:hover {
    box-shadow: 5px 5px 10px 10px;
    transition: all 1s ease;
  }

  .supprime-toi-pas:hover {
    box-shadow: 5px 5px 10px 10px;
    transition: all 1s ease;
  }

  .cotoibatard{
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: hidden ;
    backdrop-filter: blur(3px);
  }
  .contenudecotoibatard{
    margin-top: 10%;
    margin-bottom: 25%;
    margin-left: 25%;
    margin-right: 25%;
    background-color: white;
    padding: 3%;
  }
  .jeteferme {
    font-size: x-large;
    color: grey;
    font-weight: bold;
    position: relative;
    cursor: pointer;
    margin-left: 3%;
    margin-top: 2%;
  }

  .jeteferme:hover {
    color: white;
  }

  .containerpseudophoto img {
    width: 20%;
  }

  #coeur {
    margin-left: 0%;
    margin-top: 2%;
    margin-right: 1%;
  }

  #coeur:hover {
    color: red;
    transition: all 1s ease;
    transform: scale(1.5);
  }

  #commenter {
    margin-left: 120%;
    margin-top: 10%;
  }

  #commenter:hover {
    color: rgb(24, 24, 239);
    transition: all 1s ease;
    transform: scale(1.5);
  }

  #partager {
    margin-left: 135%;
    margin-top: 10%;
  }

  #partager:hover {
    color: rgb(11, 194, 11);
    transition: all 1s ease;
    transform: scale(1.5);
  }

  #coeur2 {
    margin-left: 0%;
    margin-top: 100%;
    margin-right: 1%;
  }

  .coeur2ez {
    color: red;
    transition: all 1s ease;
  }

  #coeur2:hover {
    color: red;
    transition: all 1s ease;
    transform: scale(1.5);
  }

  #commenter2 {
    margin-left: 120%;
    margin-top: 10%;
  }

  #commenter2:hover {
    color: rgb(24, 24, 239);
    transition: all 1s ease;
    transform: scale(1.5);
  }

  #partager2 {
    margin-left: 135%;
    margin-top: 10%;
  }

  #partager2:hover {
    color: rgb(11, 194, 11);
    transition: all 1s ease;
    transform: scale(1.5);
  }

  .card {
    width: 50%;
    margin-top: 4%;
    margin-bottom: 4%;
    margin-left: 20%;
  }
  .cardo {
    width: 50%;
    margin-top: 4%;
    margin-bottom: 4%;
    margin-left: 20%;
    border-radius: 1px;
    border-color: grey;
    background-color: white;
    padding: 1%;
  }

  #nombredelikes {
    margin-top: 8%;
  }

  #nombredelikes2 {
    margin-top: 8%;
  }

  #menuburger {
    position: absolute;
    top: 2.5em;
    right: 3.5em;
    display: inline-block;
    cursor: pointer;
  }

  #menuburger .bar1,
  #menuburger .bar2,
  #menuburger .bar3 {
    width: 32px;
    height: 5px;
    background-color: #F1F1F1;
    margin: 6px 0;
    transition: 0.4s;
    display: none;
  }

  #menuburger:hover {
    opacity: .75;
    transition: .5s;
  }

  #menuburger.clicked .bar1 {
    -webkit-transform: rotate(-45deg) translate(-9px, 6px);
    transform: rotate(-45deg) translate(-9px, 6px);
  }

  #menuburger.clicked .bar2 {
    opacity: 0;
  }

  #menuburger.clicked .bar3 {
    -webkit-transform: rotate(45deg) translate(-8px, -8px);
    transform: rotate(45deg) translate(-8px, -8px);
  }

  /* Main menu (slide) */
  #menu {
    position: fixed;
    z-index: 9999;
    left: -30%;
    top: auto;
    background: #3c6de7;
    padding: 4em 2em;
    width: 25%;
    min-height: 100%;
    box-shadow: 1px 0 1px #9A2519;
  }

  #menu ul li {
    list-style: none;
  }

  #menu ul li a {
    display: block;
    color: #fff;
    text-decoration: none;
    font-weight: 700;
    background: #2c3e50;
    transition: background .5s;
    padding: 1em;
    text-align: center;
    margin-bottom: .5em;
    box-shadow: 1px 1px 0 #666
  }

  #menu ul li a:hover {
    background: #f1c40f;
    transition: background .5s;
  }

  #menu.visible {
    animation: .5s slideRight ease-in forwards;
  }

  #menu.invisible {
    animation: 1s slideLeft ease-out forwards;
    transition-delay: 1s;
  }

  /* Animations pour le menu slide */
  @keyframes slideRight {
    from {
      left: -25%;
    }

    to {
      left: 0%;
    }
  }

  @-webkit-keyframes slideRight {
    from {
      left: -25%;
    }

    to {
      left: 0%;
    }
  }

  @keyframes slideLeft {
    from {
      left: 0%;
    }

    to {
      left: -50%;
    }
  }

  @-webkit-keyframes slideLeft {
    from {
      left: 0%;
    }

    to {
      left: -50%;
    }
  }

  /* Responsive design */
  @media (max-width:1024px) {
    #menu {
      left: -50%;
      width: 50%;
    }

    #menuburger.clicked {
      position: fixed;
    }

    /* Animations pour le menu slide */
    @keyframes slideRight {
      from {
        left: -50%;
      }

      to {
        left: 0%;
      }
    }

    @-webkit-keyframes slideRight {
      from {
        left: -50%;
      }

      to {
        left: 0%;
      }
    }

    @keyframes slideLeft {
      from {
        left: 0%;
      }

      to {
        left: -70%;
      }
    }

    @-webkit-keyframes slideLeft {
      from {
        left: 0%;
      }

      to {
        left: -70%;
      }
    }
  }

  @media (max-width:800px) {
    #menuburger {
      top: 0em;
      right: 0.2em;
      z-index: 9999;
      width: 10%;
      height: 2%;
    }

    #menu {
      width: 50%;
    }

    #menuburger .bar1,
    #menuburger .bar2,
    #menuburger .bar3 {
      display: block;
    }

    header .nav {
      display: none;
    }

    header form {
      display: none;
    }

    /* Animations pour le menu slide */
    @keyframes slideRight {
      from {
        left: -100%;
      }

      to {
        left: 0%;
      }
    }

    @-webkit-keyframes slideRight {
      from {
        left: -100%;
      }

      to {
        left: 0%;
      }
    }

    @keyframes slideLeft {
      from {
        left: 0%;
      }

      to {
        left: -100%;
      }
    }

    @-webkit-keyframes slideLeft {
      from {
        left: 0%;
      }

      to {
        left: -100%;
      }
    }
  }

  @media (max-width: 952px) and (min-width: 350px) {
    #commenter2 {
      margin-left: 50%;
    }

    #partager2 {
      margin-left: 50%;
    }

    #commenter {
      margin-left: 50%;
    }

    #partager {
      margin-left: 50%;
    }
  }
</style>