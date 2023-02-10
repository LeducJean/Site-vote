
<section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
          <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php

            if (isset($_POST["Delete"])) {
              $requete = "DELETE FROM `Vote` WHERE `Vote`.`idFilm` = 1 && `idUser` = 3";
              //modif idFilm et idUser
            }


            $requeteFilm = "select * from Film";
            $resultatFilm = $GLOBALS["pdo"]->query($requeteFilm);
            //resultat est du coup un objet de type PDOStatement
            $tabFilm = $resultatFilm->fetchALL();


            foreach ($tabFilm as $Film) {
            ?>

              <div class="col mb-5">
                <div class="card h-100">
                  <!-- Product image-->
                  <img class="card-img-top" src="<?= $Film["lienImg"] ?>" alt="..." />
                  <!-- Product details-->
                  <div class="card-body p-4">
                    <div class="text-center">
                      <!-- Product name-->
                      <h5 class="fw-bolder"><?= $Film["nom"] ?></h5>
                      <!-- Product price-->
                      Nombres de votes :
                      <?php
                      $nbvote = "SELECT idFilm, COUNT(idFilm) as nb FROM Vote GROUP BY idFilm";
                      $nbvote = $GLOBALS["pdo"]->query($nbvote);
                      echo "nbdevote";
                      ?>
                    </div>
                    <form action="" method="post">
                      <form action="" method="post">
                        <?php
                        if (isset($_POST["idFilm"]) && $_POST["idFilm"] == $Film["id"] && $idVote == 0) {
                          echo "vous ne pouvez pas voter 2 fois le meme jour";
                        } else if (isset($_POST["idFilm"]) && $_POST["idFilm"] == $Film["id"] && $idVote > 0) {
                          echo "Vote pris en compte";
                        }

                        ?>
                        <input type="hidden" name="idFilm" value="<?= $Film["id"] ?>" />
                        <input type="submit" value="Voter" name="Valider1"></input>
                        <input type="submit" value="Delete" name="Delete1"></input>
                      </form>
                    </form>
                  </div>
                  <!-- Product actions-->
                  <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                    </div>
                  </div>
                </div>
                <!-- id film = <?= $Film["id"] ?> -->
              </div>

            <?php
            }
            ?>


            <?php

            //$requete = "select * from User";
            //$resultat = $GLOBALS["pdo"]->query($requete);
            //resultat est du coup un objet de type PDOStatement
            //$tabUser = $resultat->fetchALL();

            /*if (isset($_POST['Valider'])) {
            if (!isset($_SESSION['click_count'])) {
              $_SESSION['click_count'] = 1;
            } else {
              $_SESSION['click_count']++;
            }
            echo "Nombre de clics : " . $_SESSION['click_count'];
          }*/

            ?>



            <?php


            $requeteVote = "SELECT Film.nom FROM `Vote`,Film WHERE Vote.idFilm = Film.id and Film.id = 2";
            $resultatVote = $GLOBALS["pdo"]->query($requeteVote);
            //resultat est du coup un objet de type PDOStatement
            //echo "le film N°2 à " . $resultatVote->rowCount() . " vote";


            $requetVoteTotal = "SELECT Film.nom as nom,COUNT(Film.id) as vote FROM `Vote`,Film WHERE Vote.idFilm = Film.id group by Film.id";
            $resultatVoteTotal = $GLOBALS["pdo"]->query($requetVoteTotal);
            foreach ($resultatVoteTotal->fetchALL() as $vote) {
              //echo "<div>le film " . $vote["nom"] . " a " . $vote["vote"] . " votes<br></div>";
            }
            ?>
          </div>
        </div>
      </section>


      <footer class="py-5 bg-dark">
        <div class="container">
          <p class="m-0 text-center text-white">Théo et Jean BTS SN 1 La PROVIDENCE</p>
        </div>
      </footer>
      <!-- Bootstrap core JS-->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Core theme JS-->
      <script src="js/scripts.js"></script>