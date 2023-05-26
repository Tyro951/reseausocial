<?php
session_start();
require_once 'config.php';
if (isset($_SESSION['user'])) { 
  $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?'); 
  $req->execute(array($_SESSION['user'])); 
  $data = $req->fetch(); 
  }
if(isset($_POST["submit"])){
  $repertoireCible = "uploads/";
  $nomFichier = basename($_FILES["image"]["name"]);
  $cheminFichierCible = $repertoireCible . $nomFichier;
  $typeFichier = pathinfo($cheminFichierCible,PATHINFO_EXTENSION);
  $formatsAutorises = array('jpg','png','gif');
  
  if(in_array($typeFichier, $formatsAutorises)){

    if(move_uploaded_file($_FILES["image"]["tmp_name"], $cheminFichierCible)){

      $requete = $bdd->prepare("SELECT image FROM tweets WHERE id_tweets = ?");
      $requete->execute(array($nomFichier));
      $URLImage = $repertoireCible . $nomFichier ;
        
          }
        }
      }
    
  if(isset($_POST['description']) and !empty($_POST['description'])) {
    $description = htmlentities($_POST['description']);
    $tags = htmlentities($_POST['tags']); 

    $insertmsg = $bdd->prepare("INSERT INTO tweets(description, tag, image, userid) VALUES(?, ?, ?, ?)");
    $insertmsg->execute(array($description, $tags, $URLImage, $data["id_utilisateurs"]));

  }

if(isset($_GET['id'])) {
  $message_id = htmlentities($_GET['id']);

  // Supprime le message de la base de données
  $req = $bdd->prepare('DELETE FROM tweets WHERE id_tweets = ? ');
  $req->execute(array($message_id));


}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Instanmanga</title>
  
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
    overflow-x: hidden;
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

  header nav {
    display: flex;
  }

  header nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
  }

  header nav ul li {
    margin-left: 35%;
  }

  header nav ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 100%;
  }
  .profilconnexion{
    text-align: center;
    color: red;
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

  .footer {
    text-align: center;
    margin-top: 20px;
  }

  @media (max-width: 1496px) and (min-width: 350px) {
    header form {
      width: 100%;
      flex-wrap: wrap;
    }

    header form input[type="text"] {
      width: 100%;
    }

    header nav {
      flex-direction: column;
      align-items: center;
      margin-top: 20px;
    }

    header nav ul {
      flex-direction: column;
    }

    header nav ul li {
      margin: 10px 0;
      text-align: center;
    }
  }

  .image-upload>input {
    display: none;
  }

  .seconnecter {
    font-family: 'Courier New', Courier, monospace;
    border-radius: 15%;
    margin-left: 45%;
  }

  .nonconnecte {
    font-style: normal;
    color: orange;
    font-size: 120%;
    margin-left: 4%;
  }

  .container {
    display: flex;
    align-items: center;
    margin-left: 35%;
  }

  .container img {
    width: 10%;
  }

  .aucunepubli {
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    font-size: 150%;
    text-align: center;
    color: grey;
    margin-top: 9%;
    display: none;
  }

  .bordure {
    margin-top: 3%;
  }

  .parametres {
    margin-top: 2%;
    margin-left: 90%;
    width: 2%;
  }

  .containerpseudophoto {
    margin-right: 70%;
    display: flex;
  }

  .containerpseudophoto h5 {
    margin-top: 3%;
  }

  .containerpseudophoto img {
    width: 20%;
  }

  .trash {
    position: absolute;
    right: 10px;
  }

  .publish {
    margin-left: 32%;
  }

  .publish img {
    width: 10%;
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
    margin-top: 2%;
    margin-right: 1%;
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

  #nombredelikes {
    margin-top: 8%;
  }

  #nombredelikes2 {
    margin-top: 8%;
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
  .orange img{
    width: 20%;
  }
  .orange{
    text-align: center;
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
</head>

<body class="daymode">
  <header>
    <div class="header-container">
      <img src="images/logoinstanmanga.png" alt="Logo">
      <form action="" method="post">
        <input type="text" placeholder="Rechercher...">
        <button type="submit">Rechercher</button>
      </form>
      <nav>
        <ul>
          <li><a href="accueil.php">Accueil</a></li>
          <li><a href="#">découvrir</a></li>
          <li><a href="#">messages</a></li>
          <li><a href="#">Notifications</a></li>
          <li><a href="profil.php">profil</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <a href="parametres.php"><img src="images/nuticon_114497.png" class="parametres" alt="paramètres"></a>
    <?php // ajout connexion bdd 
    // si la session existe pas soit si l'on est pas connecté on redirige
    if (!isset($_SESSION['user'])) {
      echo '<div class="container"><img src="images/anonyme.png" alt="?"><h2 class="nonconnecte"> Vous n êtes pas connectés </h2></div><br><button class="seconnecter" onclick="window.location.href = "index.php";">se connecter</button>';
    }  
    ?> 
    <?php
    if (isset($_SESSION['user'])) {
      if (isset($_GET['idpseudo'])) {
        ?>
        <div class="profilconnexion">
          <h3> Vous êtes sur la page de :
            <?php echo $_GET['idpseudo']; ?>
          </h3>
        </div>
        <?php
    } else {
        ?>
        <div class="profilconnexion">
          <h3> Vous êtes connecté en tant que :
            <?php echo $data['pseudo']; ?>
          </h3>
        </div>
        <?php
      }
    }
    ?>
    <hr class="bordure" style="border-top: 1px solid gray;">
    <?php
    if(!isset($_GET['idpseudo'])){
    $allmsg = $bdd->prepare('SELECT tweets.*, utilisateurs.* FROM tweets INNER JOIN utilisateurs ON tweets.userid = utilisateurs.id_utilisateurs WHERE utilisateurs.id_utilisateurs = ? ORDER BY tweets.id_tweets DESC');
    $allmsg->execute(array($data["id_utilisateurs"]));
    while ($msg = $allmsg->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <?php
      if (isset($_SESSION['user'])) { echo 'cc'?>
        <div class="card" id="card">
          <div class="card-body">
            <div class="containerpseudophoto">
              <h5 class="card-title">
                <?php echo $msg['pseudo']; ?> :
              </h5>
                <div class="trash">
                  <button id="monBtn" class="btn" ><i class="fa-solid fa-trash"></i></button>
                </div>
                <div class="jetesupprime" id="jetesupprime">
                  <div class="contenu-jetesuppr">
                    <div class="petit-contenu-jetesuppr">
                      <p class="jeteferme" id="jeteferme">&times;</p>
                      <?php echo "<a class='supprime-toi-bien' href='profil.php?id=". $msg['id_tweets']. "'>"."suppr"."</a>"; echo $msg['id_tweets'];?>
              <button class="supprime-toi-pas" id="supprime-toi-pas">supprime toi pas</button>
            </div>
          </div>
        </div>
        </div>
        <br>
        <p class="card-text">
          <?php echo $msg['description']; ?><br>
        </p>
        </div>
        <img src="<?php echo $msg['image']; ?>" class="card-img-bottom">
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
      } ?>
      <?php
    } }?>
    <?php
    if(isset($_GET['idpseudo'])){
    $allmsg = $bdd->prepare('SELECT tweets.*, utilisateurs.* FROM tweets INNER JOIN utilisateurs ON tweets.userid = utilisateurs.id_utilisateurs WHERE utilisateurs.pseudo = ? ORDER BY tweets.id_tweets DESC');
    $allmsg->execute(array($_GET['idpseudo'])); 
    while ($msg = $allmsg->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <?php
      if (isset($_SESSION['user']) and isset($_GET['idpseudo']) ) { ?>
        <div class="card" id="card">
          <div class="card-body">
            <div class="containerpseudophoto">
              <h5 class="card-title">
                <?php echo $_GET['idpseudo']; ?> :
              </h5>
                <div class="trash">
                  <button id="monBtn" class="btn" ><i class="fa-solid fa-trash"></i></button>
                </div>
                <div class="jetesupprime" id="jetesupprime">
                  <div class="contenu-jetesuppr">
                    <div class="petit-contenu-jetesuppr">
                      <p class="jeteferme" id="jeteferme">&times;</p>
                      <?php echo "<a class='supprime-toi-bien' href='profil.php?id=". $msg['id_tweets']. "'>"."suppr"."</a>"; echo $msg['id_tweets'];?>
              <button class="supprime-toi-pas" id="supprime-toi-pas">supprime toi pas</button>
            </div>
          </div>
        </div>
        </div>
        <br>
        <p class="card-text">
          <?php echo $msg['description']; ?><br>
        </p>
        </div>
        <img src="<?php echo $msg['image']; ?>" class="card-img-bottom">
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
      } ?>
      <?php
    } }?>
    <div class="orange">
      <?php
      if (isset($_SESSION['user'])) {
        echo '<br><button type="button" data-toggle="modal" data-target="#change_password"><img src="images/61183.png"></button>';
      } ?>
    </div>
    <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Publier un post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">
              <label for='current_password'>Description du post...</label>
              <input type="text" id="description" name="description" class="form-control" required /><br>
              <div class="image-upload">
                <label for="file-input">
                  <img src="https://icons.iconarchive.com/icons/dtafalonso/android-lollipop/128/Downloads-icon.png" />
                </label>

                <input id="file-input" type="file" id="image" name="image" accept=".png, .jpg, .gif" class="form-control" />
              </div> <br><br>9
              <select name="tags" id="tags">
                <option value="anime">anime</option>
                <option value="manga">manga</option>
                <option value="webtoon">Webtoons</option>
              </select>
              <button type="submit" name ="submit" class="btn btn-success">publier</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">annuler</button>
          </div>
        </div>
      </div>
    </div>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/30e89f8594.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="supprimerunpost.js"></script>
    <script src="localstorage.js"></script>
</body>

</html>