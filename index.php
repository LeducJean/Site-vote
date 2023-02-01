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
  
    <div id="form-container">
      <form action="action.php" method="post">
        <label for="username">Pseudo:</label>
        <input type="text" id="username" name="username">

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password">

        <input type="submit" value="Connexion">
        <a href="register.php">S'inscrire</a>
      </form>
    </div>




<?php

  $username = $_POST['username'];
  $password = $_POST['password'];

  // Connecter à la base de données
  $conn = mysqli_connect("hostname", "username", "password", "database");

  // Vérifier la connexion
  if (!$conn) {
    die("Erreur de connexion: " . mysqli_connect_error());
  }

  // Requête pour vérifier les informations d'identification
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // Les informations d'identification sont correctes
    // Démarrer la session et rediriger vers la page protégée
    session_start();
    $_SESSION['loggedin'] = true;
   
  }

?>

</body>
</html>