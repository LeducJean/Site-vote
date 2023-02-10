<?php session_start();
//MAJ + ALT + F
if (isset($_POST['deconnexion'])) {
  session_unset();
  session_destroy();
}

//barre de recherche SELECT * FROM `Film` where Film.nom like '%r%'; 


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Site</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Bootstrap icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
</head>

<body>

  <header class="bg-dark py-5">
    <div class="deco">
      <form action="" method="post">
        <input type="submit" name="deconnexion" value="se déco"></input>
        </form>
      </form>
    </div>
    <div class="recherche">
      <form action="" method="post">
        <form action="verif-form.php" method="get">
          <input type="search" name="terme">
          <input type="submit" name="rechercher" value="Rechercher">
        </form>
      </form>
    </div>
    <div class="container px-4 px-lg-5 my-5">
      <div class="text-center text-white">
        <h1 class="display-4 fw-bolder">Vote pour ton film préféré !</h1>
        <p class="lead fw-normal text-white-50 mb-0">Tu as le droit de voter 1 fois par jour</p>
      </div>
    </div>
  </header>

  <?php
  $ipserver = "192.168.65.164";
  $nomBase = "VoteFilm";
  $loginPrivilege = "root";
  $passPrivilege = "root";

  try {
    $GLOBALS["pdo"] = new PDO('mysql:host=' . $ipserver . ';dbname=' . $nomBase . '', $loginPrivilege, $passPrivilege);
  } catch (Exception $e) {
    echo $e->getMessage();
  }





  if (isset($_POST['connexion'])) {
    $pseudo = stripslashes($_REQUEST['pseudo']);
    $mdp = stripslashes($_REQUEST['mdp']);
    $query = "SELECT * FROM User WHERE pseudo='" . $_POST['pseudo'] . "' AND mdp='" . $_POST['mdp'] . "'";
    $resultat = $GLOBALS["pdo"]->query($query);
    if ($resultat->rowCount() > 0) {
      $tab = $resultat->fetch();
      $_SESSION["idUser"] = $tab["id"];
    } else {
      echo "Pseudo ou mot de passe incorrect";
    }
  }



  if (isset($_SESSION["idUser"]) && $_SESSION["idUser"] > 0) {
    $idVote = -1;


    if (isset($_POST["Valider1"])) {
      //echo "Vous avez voter pour = ".$_POST["idFilm"]."";
      //echo "julien";
      //$requete = "INSERT INTO `Vote` (`idFilm`,`idUser`, `DATE`) VALUES ('".$_POST["idFilm"]."','3','".$_POST["DATE"]."')";
      $requete = "INSERT INTO `Vote` ( `idFilm`, `idUser`, `DATE`) VALUES ( '" . $_POST["idFilm"] . "', '" . $_SESSION["idUser"] . "', '" . date("y-m-d") . "')";
      //echo $requete;
      $resultat = $GLOBALS["pdo"]->query($requete);
      //modif idUser
      $idVote =  $GLOBALS["pdo"]->lastInsertId();
      //echo $idVote;
    }



  ?>
    <section class="py-5">
      <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
          <?php

          if (isset($_POST["Delete"])) {
            $requete = "DELETE FROM `Vote` WHERE `Vote`.`idFilm` = 1 && `idUser` = 3";
            //modif idFilm et idUser
          }


          $requeteFilm = "select * from Film";
          $resultatFilm = $GLOBALS["pdo"]->query($requeteFilm);
          //resultat est du coup un objet de type PDOStatement
          $tabFilm = $resultatFilm->fetchALL();


          foreach ($tabFilm as $Film) {
          ?>

            <div class="col mb-5">
              <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top" src="<?= $Film["lienImg"] ?>" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                  <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder"><?= $Film["nom"] ?></h5>
                    <!-- Product price-->
                    Nombres de votes :
                  </div>

                  <?php


                  $requetVoteTotal = "SELECT Film.nom as nom,COUNT(Film.id) as vote FROM `Vote`,Film WHERE Vote.idFilm = Film.id group by Film.id";
                  $resultatVoteTotal = $GLOBALS["pdo"]->query($requetVoteTotal);
                  foreach ($resultatVoteTotal->fetchALL() as $vote) {
                    echo "<div>le film " . $vote["nom"] . " a " . $vote["vote"] . " votes<br></div>";
                  }
                  ?>
                  <form action="" method="post">
                    <form action="" method="post">
                      <?php
                      if (isset($_POST["idFilm"]) && $_POST["idFilm"] == $Film["id"] && $idVote == 0) {
                        echo "vous ne pouvez pas voter 2 fois le meme jour";
                      } else if (isset($_POST["idFilm"]) && $_POST["idFilm"] == $Film["id"] && $idVote > 0) {
                        echo "Vote pris en compte";
                      }

                      ?>
                      <input type="hidden" name="idFilm" value="<?= $Film["id"] ?>" />
                      <input type="submit" value="Voter" name="Valider1"></input>
                      <input type="submit" value="Delete" name="Delete1"></input>
                    </form>
                  </form>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                  <div class="text-center">
                  </div>
                </div>
              </div>
              <!-- id film = <?= $Film["id"] ?> -->
            </div>

          <?php
          }
          ?>


          <?php

          //$requete = "select * from User";
          //$resultat = $GLOBALS["pdo"]->query($requete);
          //resultat est du coup un objet de type PDOStatement
          //$tabUser = $resultat->fetchALL();

          /*if (isset($_POST['Valider'])) {
            if (!isset($_SESSION['click_count'])) {
              $_SESSION['click_count'] = 1;
            } else {
              $_SESSION['click_count']++;
            }
            echo "Nombre de clics : " . $_SESSION['click_count'];
          }*/

          ?>



          <?php


          $requeteVote = "SELECT Film.nom FROM `Vote`,Film WHERE Vote.idFilm = Film.id and Film.id = 2";
          $resultatVote = $GLOBALS["pdo"]->query($requeteVote);
          //resultat est du coup un objet de type PDOStatement
          //echo "le film N°2 à " . $resultatVote->rowCount() . " vote";


          $requetVoteTotal = "SELECT Film.nom as nom,COUNT(Film.id) as vote FROM `Vote`,Film WHERE Vote.idFilm = Film.id group by Film.id";
          $resultatVoteTotal = $GLOBALS["pdo"]->query($requetVoteTotal);
          foreach ($resultatVoteTotal->fetchALL() as $vote) {
            //echo "<div>le film " . $vote["nom"] . " a " . $vote["vote"] . " votes<br></div>";
          }
          ?>
        </div>
      </div>
    </section>
  <?php
  } else {
  ?>

    <div class="login-form">
      <form action="" method="post">
        <h2>Se connecter</h2>
        <div class="form-group">
          <label for="username">Nom d'utilisateur : (4 caractères min)</label>
          <input type="text" placeholder="Pseudo" name="pseudo" required minlength="4">
        </div>
        <div class="form-group">
          <label for="password">Mot de passe : (4 caractères min)</label>
          <input type="password" placeholder="Password" name="mdp" required minlength="4">
        </div>
        <input type="submit" name="connexion" value="Se connecter"></input>
        <?php if (!empty($message)) { ?>
          <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>
      </form>

      <form action="inscription.php" method="">
        <input type="submit" name="inscription" value="Inscrivez-vous"></input>
      </form>

    </div>

  <?php
  } ?>

  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Théo et Jean BTS SN 1 La PROVIDENCE</p>
    </div>
  </footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>

</body>

</html>