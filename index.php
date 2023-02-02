<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylessheet" href="main.css">
    <title>Site vote</title>
</head>

<head>
    <link rel="stylesheet" href="main.css">
</head>


<body>
	<div class="login-form">
		<form action="login.php" method="post">
			<h2>Se connecter</h2>
			<div class="form-group">
				<label for="username">Nom d'utilisateur:</label>
				<input type="text" name="username" id="username" required>
			</div>
			<div class="form-group">
				<label for="password">Mot de passe:</label>
				<input type="password" name="password" id="password" required>
			</div>
			<input type="submit" value="Se connecter">
		</form>
	</div>







  <?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
	// Connexion à la base de données
	$db = mysqli_connect('host', 'username', 'password', 'database');
	
	// Récupération des données du formulaire
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// Vérification de l'existence de l'utilisateur dans la base de données
	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result = mysqli_query($db, $query);
	
	if (mysqli_num_rows($result) == 1) {
		// Connexion réussie
		$_SESSION['username'] = $username;
		header("Location: welcome.php");
	} else {
		// Connexion échouée
		echo "Nom d'utilisateur ou mot de passe incorrect.";
	}
	
	mysqli_close($db);
}
?>


</body>
</html>