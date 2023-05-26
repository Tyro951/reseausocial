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

            if(isset($_POST['description']) and !empty($_POST['description'])) {
              $description = htmlentities($_POST['description']);
              $tags = htmlentities($_POST['tags']); 
              $insertmsg = $bdd->prepare("INSERT INTO tweets(description, tag, image, userid) VALUES(?, ?, ?, ?)");
              $insertmsg->execute(array($description, $tags, $cheminFichierCible, $data["id_utilisateurs"]));
            }
    }
  }
  if(isset($_POST['description']) and !empty($_POST['description'])) {
    $description = htmlentities($_POST['description']);
    $tags = htmlentities($_POST['tags']);
    if(!$nomFichier){
      $insertmsg = $bdd->prepare("INSERT INTO tweets(description, tag, userid) VALUES(?, ?, ?)");
      $insertmsg->execute(array($description, $tags, $data["id_utilisateurs"]));
    }
  }
}
    


if(isset($_GET['id'])) {
  $message_id = htmlentities($_GET['id']);

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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/profil.css">
  <title>Instanmanga</title>
  
</head>

<body class="daymode">
  <header>
    <div class="header-container">
      <img src="images/logoinstanmanga.png" alt="Logo">
      <form method="post">
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
    <?php 
    if (!isset($_SESSION['user'])) {
      echo '<div class="container"><img src="images/anonyme.png" alt="?"><h2 class="nonconnecte"> Vous n êtes pas connectés </h2></div><br><button class="seconnecter"><a href="index.php">se connecter</a></button>';
    }  
    ?> 
    <?php
    if (isset($_SESSION['user'])) {
      if (isset($_GET['idpseudo']) and $_GET['idpseudo']!= $data['pseudo']) {
        ?>
        <div class="profilconnexion">
          <h3> Vous êtes sur la page de :
            <?php echo $_GET['idpseudo']; ?>
          </h3>
        </div>
        <?php
    } 
    else {
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
    if(!isset($_GET['idpseudo']) and isset($_SESSION['user'])){
    $allmsg = $bdd->prepare('SELECT tweets.*, utilisateurs.* FROM tweets INNER JOIN utilisateurs ON tweets.userid = utilisateurs.id_utilisateurs WHERE utilisateurs.id_utilisateurs = ? ORDER BY tweets.id_tweets DESC');
    $allmsg->execute(array($data["id_utilisateurs"]));
    while ($msg = $allmsg->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <?php
      if (isset($_SESSION['user'])) { ?>
        <div class="card">
          <div class="card-body">
            <div class="containerpseudophoto">
              <h5 class="card-title">
                <?php echo $msg['pseudo']; ?> :
              </h5>
                <div class="trash">
                  <button class="btn poubelle" ><i class="fa-solid fa-trash"></i></button>
                </div>
                <div class="jetesupprime" >
                  <div class="contenu-jetesuppr">
                    <div class="petit-contenu-jetesuppr">
                      <p class="jeteferme" >&times;</p>
                      <?php echo "<a class='supprime-toi-bien' href='profil.php?id=". $msg['id_tweets']. "'>"."suppr"."</a>"; echo $msg['id_tweets'];?>
              <button class="supprime-toi-pas" >supprime toi pas</button>
            </div>
          </div>
        </div>
        </div>
        <br>
        <p class="card-text">
          <?php echo $msg['description']; ?><br>
        </p>
        </div>
        <?php if($msg['image'] != NULL ){  ?>
        <img src="<?php echo $msg['image']; ?>" alt="imageupload" class="card-img-bottom"> <?php } ?>
        <div class="containerpseudophoto">
          <button class="btn"><i class="coeur fa-solid fa-heart"></i></button>
          <p class="nombredelikes" > 0 </p>
          <i class="commenter fa-solid fa-comment" ></i>
          <i class="partager fa-solid fa-share" ></i>
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
        <div class="card" >
          <div class="card-body">
            <div class="containerpseudophoto">
              <h5 class="card-title">
                <?php echo $msg['pseudo']; ?> :
              </h5>
                <div class="trash">
                  <button class="btn poubelle" ><i class="fa-solid fa-trash"></i></button>
                </div>
                <div class="jetesupprime" >
                  <div class="contenu-jetesuppr">
                    <div class="petit-contenu-jetesuppr">
                      <p class="jeteferme" >&times;</p>
                      <?php echo "<a class='supprime-toi-bien' href='profil.php?id=". $msg['id_tweets']. "'>"."suppr"."</a>"; echo $msg['id_tweets'];?>
              <button class="supprime-toi-pas" >supprime toi pas</button>
            </div>
          </div>
        </div>
        </div>
        <br>
        <p class="card-text">
          <?php echo $msg['description']; ?><br>
        </p>
        </div>
        <?php if($msg['image'] != NULL ){  ?>
        <img src="<?php echo $msg['image']; ?>" class="card-img-bottom" alt="imagedelapersonnequiupload"> <?php } ?>
        <div class="containerpseudophoto">
          <button class="btn"><i class="coeur fa-solid fa-heart"></i></button>
          <p class="nombredelikes" > 0 </p>
          <i class="commenter fa-solid fa-comment" ></i>
          <i class="partager fa-solid fa-share" ></i>
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
        echo '<br><button type="button" id="publier" data-toggle="modal" data-target="#change_password" onclick="ouvretoi()"><img src="images/61183.png" alt="imageupload"></button>';
      } ?>
    </div>
    <div id="modal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Publier un post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" enctype="multipart/form-data">
              <label for='description'>Description du post...</label>
              <input type="text" id="description" name="description" class="description form-control" required ><br>
              <div class="image-upload">
                <label for="file-input">
                  <img src="https://icons.iconarchive.com/icons/dtafalonso/android-lollipop/128/Downloads-icon.png" alt="upload image">
                </label>

                <input id="file-input" type="file" name="image" accept=".png, .jpg, .gif" class="form-control" >
              </div> <br><br>
              <select name="tags" id="tags">
                <option value="anime">anime</option>
                <option value="manga">manga</option>
                <option value="webtoon">Webtoons</option>
              </select>
              <button type="submit" name ="submit" class="btn btn-success">publier</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="annuler">annuler</button>
          </div>
        </div>
      </div>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/30e89f8594.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
    <script src="js/supprimerunpost.js"></script>
</body>

</html>