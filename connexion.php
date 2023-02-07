<?php session_start();
if(isset($_POST['deconnexion'])) {
  echo "vider la session puis la destroy";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="inscription.css">
  <title>S'inscrire</title>
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
    echo "toto 1";
    $pseudo = stripslashes($_REQUEST['pseudo']);
    $mdp = stripslashes($_REQUEST['mdp']);
    $query = "SELECT * FROM User WHERE pseudo='" . $_POST['pseudo'] . "' AND mdp='" . $_POST['mdp'] . "'";
    echo $query;
    $resultat = $GLOBALS["pdo"]->query($query);
    if($resultat->rowCount()>0){
      echo "toto 3";
      $_SESSION["connexion"]= true;
    }
    //remplacer "password" en "mdp" ou inverse (en haut)"

   
  }else{
    echo "toto 2";
  }



  if(isset($_SESSION["connexion"]) && $_SESSION["connexion"] == true){
    ?> <form action="" method="post">
    <input type="submit" name="deconnexion" value="se déconnecté"></input>
  </form>
      faire formulaire de deconnxion
    <?php echo "je suis connecté";
  }else{
  ?>

  <div class="login-form"> 
    <form action="" method="post">
      <h2>Se connecter</h2>
      <div class="form-group">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" placeholder="Pseudo" name="pseudo">
      </div>
      <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" placeholder="Password" name="mdp">
      </div>
      <input type="submit" name="connexion" value="Se connecter"></input>
      <?php if (!empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
      <?php } ?>
    </form>

    <form action="inscription.php" method="post">
      <input type="submit" name="inscription" value="Inscrivez-vous"></input>
    </form>

  </div>

<?php  } ?>

</body>

</html>