<?php
$bdd = new PDO("mysql:host=localhost;dbname=social_network;charset=utf8", "root", "");
if (isset($_POST['supprimertweet'])) {
  $message_id = $_POST['message_id'];

  // Supprimer le message de la base de données
  $req = $bdd->prepare('DELETE FROM tweets WHERE id_tweets = ? ');
  $req->execute(array($message_id));

  // Rediriger vers la page précédente
  header('Location: ' . $_SERVER['HTTP_REFERER']);

}

?>
<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="css/accueil.css"> 
  <title>Instanmanga</title>
</head>

<body>
  <header>
    <div class="header-container">
      <img src="images/logoinstanmanga.png" alt="Logo">
      <form method="get">
        <input type="text" name="motscles" placeholder="Rechercher..." >
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
        <li><button id="animebtn1" class="animebtn" data-tag="manga" > MANGAS </button></li>
        <li><button id="animebtn2" class="animebtn" data-tag="webtoon" > WEBTOONS </button></li>
      </ul>
    <h2 class="tendances"> Tendances du moment : </h2>
    <?php
    session_start();
    $allmsg = $bdd->query('SELECT tweets.*, utilisateurs.pseudo FROM tweets INNER JOIN utilisateurs ON tweets.userid = utilisateurs.id_utilisateurs ORDER BY tweets.id_tweets DESC');
    while ($msg = $allmsg->fetch()) { ?>
      <?php
      if (isset($_SESSION['user'])) { ?>
      <i id="modalflottant" class="fa-solid fa-pen-nib fa-fade" onclick="ouvretoi()"></i>
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
              <label for='current_password'>Description du post...</label>
              <input type="text" id="description" name="description" class="form-control" required ><br>
              <div class="image-upload">
                <label for="file-input">
                  <img src="https://icons.iconarchive.com/icons/dtafalonso/android-lollipop/128/Downloads-icon.png" alt="upload image">
                </label>

                <input id="file-input" type="file" id="image" name="image" accept=".png, .jpg, .gif" class="form-control" >
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
        <div class="card <?php echo $msg['tag']; ?>" id="card">
          <div class="card-body">
            <div class="containerpseudophoto">
              <h5 class="card-title">
                <?php $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
                $req->execute(array($_SESSION['user']));
                $data = $req->fetch();
                echo "<a class='supprime-toi-bien' href='profil.php?idpseudo=". $msg['pseudo']. "'>".$msg['pseudo']."</a>";
                ?> :
              </h5>
              <div class="trash">
                <button id="monBtn" class="btn"><i class="fa-solid fa-trash"></i></button>
              </div>
              <form method="POST">
                <div class="jetesupprime">
                  <div class="contenu-jetesuppr">
                    <div class="petit-contenu-jetesuppr">
                      <p class="jeteferme"></p>
                      <input type="hidden" name="message_id" value="<?php echo $msg['id_tweets']; ?>">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <br>
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
          <p class="card-text">
            <small class="text-muted">
              <?php echo $msg['date']; ?><br>
            </small>
          </p>
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
                <button id="monBtn" class="btn"><i class="fa-solid fa-trash"></i></button>
              </div>
              <form method="POST">
                <div class="jetesupprime">
                  <div class="contenu-jetesuppr">
                    <div class="petit-contenu-jetesuppr">
                      <p class="jeteferme"></p>
                      <input type="hidden" name="message_id" value="<?php echo $msg['id_tweets']; ?>">
                    </div>  
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <br>
        <p class="card-text">
          <?php echo $msg['description']; ?><br>
        </p>
        <div class="containerpseudophoto">
          <button id="monBtn" class="btn"><i class="fa-solid fa-heart" id="coeur"></i></button>
          <p id="nombredelikes"> 0 </p>
          <i class="fa-solid fa-comment" id="commenter"></i>
          <i class="fa-solid fa-share" id="partager"></i>
        </div>
        <p class="card-text">
          <small class="text-muted">
            <?php echo $msg['date']; ?><br>
          </small>
        </p>
        <?php
      }
     } ?>
      <?php
    } ?>
    <?php if (!isset($_SESSION['user'])) { ?>
    <div class="cotoi" id="cotoi">
      <div class="contenudecotoi" id="contenudecotoi">
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/30e89f8594.js" crossorigin="anonymous"></script>
<script src="js/swipe-menu.js" async></script>
<script src="js/inscris-toi.js"></script>
</html>