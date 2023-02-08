<?php session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="site.css">
  <title>Site</title>
</head>

<body>

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
    if($resultat->rowCount()>0){
      $_SESSION["connexion"]= true;
    }else {
      echo "Pseudo ou mot de passe incorrect";
    }
  }



  if(isset($_SESSION["connexion"]) && $_SESSION["connexion"] == true){
    ?>
     

  <?php
  if(isset($_POST['deconnexion'])) {
    session_unset();
    session_destroy();
    header("location: ");
}

?>


  <!-- formulaire de déconnexion -->

    <?php

    //insérer le site ici

    
    include'SiteBoos.html';


    

//"SELECT * FROM `Vote` WHERE idFilm = 1";

if (isset($_POST["Valider"])) {
  echo "Vous avez voter pour = ".$_POST["idFilm"]."";
  $requete = "INSERT INTO `Vote` (`idFilm`,`idUser`, `DATE`) VALUES ('".$_POST["idFilm"]."','3','".$_POST["DATE"]."')";
  //modif idUser
  }

 
  if (isset($_POST["Delete"])) {
          $requete = "DELETE FROM `Vote` WHERE `Vote`.`idFilm` = 1 && `idUser` = 3";
          //modif idFilm et idUser
  }
  //.$_POST["idUser"].
  //`idUser`
  //DELETE FROM `Vote` WHERE `Vote`.`id` = 23
  
  //$resultat = $GLOBALS["pdo"]->query($requete);

  $requeteFilm = "select * from Film";
  $resultatFilm = $GLOBALS["pdo"]->query($requeteFilm);
  //resultat est du coup un objet de type PDOStatement
  $tabFilm = $resultatFilm->fetchALL();

      

  //$requete = "select * from User";
  //$resultat = $GLOBALS["pdo"]->query($requete);
  //resultat est du coup un objet de type PDOStatement
  //$tabUser = $resultat->fetchALL();

  if(isset($_POST['Valider'])){
    if(!isset($_SESSION['click_count'])){
      $_SESSION['click_count'] = 1;
    } else {
      $_SESSION['click_count']++;
    }
    echo "Nombre de clics : ".$_SESSION['click_count'];
  }
  
  ?>
   <form action="" method="post">
      <select name="idFilm">
          <?php
          foreach ($tabFilm as $Film) {
              ?>
              <option value="<?=$Film["id"]?>"><?=$Film["nom"]." ".$Film["annee"]?></option>
              <?php
          }
          ?>
      </select>
      <input type="datetime-local" name="DATE">
      <input type="submit" value="Voter" name="Valider">
      <input type="submit" value="Delete" name="Delete">
      <img src="https://fr.web.img2.acsta.net/c_310_420/pictures/22/08/25/09/04/2146702.jpg"alt="Logo HubSpot" width=10% height=10%/>
  </form>

  
<?php


      $requeteVote = "SELECT Film.nom FROM `Vote`,Film WHERE Vote.idFilm = Film.id and Film.id = 2";
      $resultatVote = $GLOBALS["pdo"]->query($requeteVote);
      //resultat est du coup un objet de type PDOStatement
      echo "le film N°2 à " . $resultatVote->rowCount() . " vote";


      $requetVoteTotal = "SELECT Film.nom as nom,COUNT(Film.id) as vote FROM `Vote`,Film WHERE Vote.idFilm = Film.id group by Film.id";
      $resultatVoteTotal = $GLOBALS["pdo"]->query($requetVoteTotal);
      foreach ($resultatVoteTotal->fetchALL() as $vote) {
          echo "<div>le film " . $vote["nom"] . " a " . $vote["vote"] . " votes<br></div>";
      }






    

  }else{
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

<?php  } ?>

</body>

</html>