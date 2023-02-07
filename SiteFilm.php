<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
<?php 



try {

    $ipserver ="192.168.65.164";
    $nomBase = "VoteFilm";
    $loginPrivilege ="root";
    $passPrivilege ="root";

    $GLOBALS["pdo"] = new PDO('mysql:host=' . $ipserver . ';dbname=' . $nomBase . '', $loginPrivilege, $passPrivilege);



    if (isset($_POST["Valider"])) {
    echo "idFilm = ".$_POST["idFilm"]." idUser = ".$Post["idUser"]." DATE = ".$_POST["DATE"];
    }
    $requete = "INSERT INTO `Vote` (`idFilm`,`idUser`, `DATE`) VALUES ('".$_POST["idFilm"]."','3','".$_POST["DATE"]."')";
    //.$_POST["idUser"].
    //`idUser`
    //YOUPI
    $resultat = $GLOBALS["pdo"]->query($requete);

    $requeteFilm = "select * from Film";
    $resultatFilm = $GLOBALS["pdo"]->query($requeteFilm);
    //resultat est du coup un objet de type PDOStatement
    $tabFilm = $resultatFilm->fetchALL();


    //$requete = "select * from User";
    //$resultat = $GLOBALS["pdo"]->query($requete);
    //resultat est du coup un objet de type PDOStatement
    //$tabUser = $resultat->fetchALL();

    

    ?>
     <form action="" method="post">
        <select name="idFilm">
            <?php
            foreach ($tabFilm as $Film) {
                ?>
                <option value="<?=$Film["id"]?>"><?=$Film["nom"]." ".$Film["prenom"]?></option>
                <?php
            }
            ?>
        </select>
        <input type="datetime-local" name="DATE">
        <input type="submit" value="Voter" name="Valider">
    </form>

    

<?php



} catch (Exception  $error) {
    echo "error est : ".$error->getMessage();
}




?> 



</body>
</html>