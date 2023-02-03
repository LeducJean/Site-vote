<?php echo "<h1>coucou je suis pres et vous ?</h1>";



try {

    $ipserver ="192.168.65.193";
    $nomBase = "Medecin";
    $loginPrivilege ="SiteWeb";
    $passPrivilege ="SiteWeb";

    $GLOBALS["pdo"] = new PDO('mysql:host=' . $ipserver . ';dbname=' . $nomBase . '', $loginPrivilege, $passPrivilege);


    if(isset($_POST["Valider"])){
        echo "idMedecin = ".$_POST["idMedecin"]." id patient = ".$_POST["idPatient"]." date = ".$_POST["laDate"];
        //COMME J'AI LES 2 ID
        //je fait une requet pour faire un insert into consultation .... value ( 'idmedecin', 'idpatien', 'date')
        $requete = "INSERT INTO `Consultation` (`Dateheure`, `idMedecin`, `idPatient`) 
                    VALUES 
                    ( '".$_POST["laDate"]."', '".$_POST["idMedecin"]."', '".$_POST["idPatient"]."');";
        $resultat = $GLOBALS["pdo"]->query($requete);
        
    }

    $requete = "select * from Medecin";
    $resultat = $GLOBALS["pdo"]->query($requete);
    //resultat est du coup un objet de type PDOStatement
    $tabMedecins = $resultat->fetchALL();

    $requete = "select * from Patient";
    $resultat = $GLOBALS["pdo"]->query($requete);
    //resultat est du coup un objet de type PDOStatement
    $tabPatients = $resultat->fetchALL();
    ?>
    <form action="" method="post">
        <select name="idMedecin">
            <?php
            foreach ($tabMedecins as $Medecin) {
                ?>
                <option value="<?=$Medecin["id"]?>"><?=$Medecin["nom"]." ".$Medecin["prenom"]?>s</option>
                <?php
            }
            ?>
        </select>
        <select name="idPatient">
            <?php
            foreach ($tabPatients as $Patient) {
                ?>
                <option value="<?=$Patient["id"]?>"><?=$Patient["nom"]." ".$Patient["prenom"]?>s</option>
                <?php
            }
            ?>
        </select>
        <input type="datetime-local" name="laDate">
        <input type="submit" value="Saisir une consultation" name="Valider">
    </form>
    
<?php
} catch (Exception  $error) {
    echo "error est : ".$error->getMessage();
}


/*

RequetSql = "Select Film.id,Film.titre,Film.resume,Film.lienImage, AVG(Note.note) as 'note'
         FROM Film,Note,User
        WHERE
        Film.id = Note.idFilm
        AND
        Note.idUser = User.id
        AND
        Film.id = '" . $id . "'  
        Group By Film.id;";

        $resultat = $GLOBALS["pdo"]->query($RequetSql); //resultat sera de type pdoStatement
        if ($resultat->rowCount() > 0) {
            $tab = $resultat->fetch();
            $this->id_ = $tab['id'];
            $this->titre_ = $tab['titre'];
            $this->resume_ = $tab['resume'];
            $this->lienImage_ = $tab['lienImage'];
            $this->MoyenneNote_ = $tab['note'];
        }
*/

highlight_string( file_get_contents($_SERVER['SCRIPT_FILENAME']));
?>