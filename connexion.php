<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<head>
    <link rel="stylesheet" href="connexion.css">
</head>

<body>

<div class="login-form">
		<form action="SiteFilm.php" method="post">
			<h2>Se connecter</h2>
			<div class="form-group">
				<label for="username">Nom d'utilisateur:</label>
				<input type="text" placeholder="Pseudo" name="pseudo" id="username" required>
			</div>
			<div class="form-group">
				<label for="password">Mot de passe:</label>
				<input type="password" placeholder="Password" name="password" id="password" required>
			</div>
			<input type="submit" value="Se connecter">
		</form>
		<form action="inscription.php" target="_blank">
					<input type="submit" value="Inscription">
				</form>
	</div>

</body>
</html>