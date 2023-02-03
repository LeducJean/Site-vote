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
		</form>
		<form action="connexion.php"" target="_blank">
					<input type="submit" name="Inscription" value="inscription"></input>
				</form>
	</div>

<?php

if(isset($_POST["inscription"])){
    $requeteUser = "INSERT INTO 'User' ('pseudo', 'mdp') VALUES ('" .$_POST['pseudo'] . "','" .$_POST['mdp']."')";
    $result2 = $GLOBALS["pdo"]->query($requeteUser);
}

 ?>

</body>
</html>