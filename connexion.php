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
    echo "début";
}catch(Exception $e){
    echo $e->getMessage();
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
            <input type="submit" name="login" value="Se connecter"></input>
				</form>
                <form action="inscription.php" method="post">
                <input type="submit" name="inscription" value="inscription"></input>
</form>
	</div>

<?php

$pseudo = $_POST['pseudo'];
$mdp = $_POST['mdp'];

$query = "SELECT * FROM User WHERE pseudo='$pseudo' AND mdp = '$mdp'";
$reseult = mysql_query($conn, $query);
$row = mysql_fetch_assoc($result);

if(mysql_num_rows($result) > 0) {
    $role = $row['role'];
    $_SESSION["Login"] = $pseudo;
    $_SESSION["mdp"] = $mdp;
    $_SESSION["Isconnect"] = true;
}

 ?>

</body>
</html>