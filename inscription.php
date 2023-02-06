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



?>

	<div class="login-form">
		<form action="" method="post">
			<h2>S'inscrire</h2>
			<div class="form-group">
				<label for="username">Nom d'utilisateur:</label>
				<input type="text" placeholder="Pseudo" name="pseudo">
			</div>
			<div class="form-group">
				<label for="password">Mot de passe:</label>
				<input type="password" placeholder="Password" name="mdp">
			</div>
					<input type="submit" name="inscription" value="S'inscrire"></input>
				</form>
		<form action="connexion.php" method="post">
		<input type="submit" name="se connecter" value="Connectez-vous"></input>
	</div>

<?php
if(isset($_POST["inscription"])){
    $requeteUser = "INSERT INTO User (pseudo, mdp) VALUES ('" .$_POST['pseudo']. "','" .$_POST['mdp']."')";
    $result2 = $GLOBALS["pdo"]->query($requeteUser);
}

 ?>

</body>
</html>