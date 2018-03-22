<?php //include "../inc/dbinfo.inc"; ?>

<?php
session_start();

/*$dbhost = DB_SERVER;
$dbport = DB_PORT;
$dbname = DB_DATABASE;
$charset = 'utf8' ;
$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$username = DB_USERNAME;
$password = DB_PASSWORD;

$pdo = new PDO($dsn, $username, $password);*/

$pdo = new PDO('mysql:host=localhost;dbname=soundme', 'root','');

$photo_studio = $data['photo_studio'];

?>
		


<html> 

<!-- il reste encore à relier le php à la bdd -->

    <body>

      <cover>

      	<img src="<?php echo $photo_studio ?>" width="auto" height="320" />

      </cover>

      <?php echo $_SESSION["nom_studio"] . " - " . $_SESSION["adresse_studio"]; ?>


      <div id="salles"> 

      <h2>Ce studio dispose de <?php echo $_SESSION["nombre_salle"] ?> salles d'enregistrement.</h2>

      <p class="salle">Salle n°1</p>
      	<p class="description">
      		Surface: <?php echo $_SESSION["surface_salle"] ?> m²
      		Capacité: <?php echo $_SESSION["nbr_max_personnes"] ?> personnes
      		Prix horaire: <?php echo $_SESSION["prix_salle"] ?> €
      	</p>

      <p class="salle">Salle n°2</p>
      	<p class="description">
      		Surface: <?php echo $_SESSION["surface_salle"] ?> m²
      		Capacité: <?php echo $_SESSION["nbr_max_personnes"] ?> personnes
      		Prix horaire: <?php echo $_SESSION["prix_salle"] ?> €
      	</p>

      <p class="salle">Salle n°3</p>
      	<p class="description">
      		Surface: <?php echo $_SESSION["surface_salle"] ?> m²
      		Capacité: <?php echo $_SESSION["nbr_max_personnes"] ?> personnes
      		Prix horaire: <?php echo $_SESSION["prix_salle"] ?> €
      	</p>

       </div>

       

       <div id="planning">

  

       </div>

    </body>

</html>