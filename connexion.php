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
$ipserver ="192.168.65.164";
$nomBase = "VoteFilm";
$loginPrivilege = "root";
$passPrivilege = "root";

try{
    $GLOBALS["pdo"] = new PDO('mysql:host=' . $ipserver . ';dbname=' . $nomBase . '', $loginPrivilege, $passPrivilege);
}catch(Exception $e){
    echo $e->getMessage();
}


session_start();
if (isset($_POST['se connecter'])){
  $pseudo = stripslashes($_REQUEST['pseudo']);
  $pseudo = mysqli_real_escape_string($conn, $pseudo);
  $mdp = stripslashes($_REQUEST['mdp']);
  $mdp = mysqli_real_escape_string($conn, $mdp);
  $query = "SELECT INTO User (pseudo, mdp) VALUES ('" .$_POST['pseudo']. "','" .$_POST['mdp']."')";
  $pdo->query($query);

	//remplacer "password" en "mdp" ou inverse (en haut)"

  $result = mysqli_query($conn,$query) or die(mysql_error());
  $rows = mysqli_num_rows($result);
  if($rows==1){
      $_SESSION['pseudo'] = $pseudo;
      include'SiteFilm.php';
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }
}
?>



<div class="login-form">
		<form action="" method="post">
			<h2>Se connecter</h2>
			<div class="form-group">
				<label for="username">Nom d'utilisateur:</label>
				<input type="text" placeholder="Pseudo" name="pseudo">
			</div>
			<div class="form-group">
				<label for="password">Mot de passe:</label>
				<input type="password" placeholder="Password" name="mdp">
			</div>
					<input type="submit" name="se connecter" value="Se connecter"></input>
            





<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>
<form action="inscription.php" method="post">
  <input type="submit" name="inscription" value="Inscrivez-vous"></input>
</form>
</div>



</body>
</html>