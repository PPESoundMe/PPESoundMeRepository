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

<head>
     <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="SoundMe Réseau Social">
      <meta name="keywords" content="SoundMe, music, rencontre, réseau, social, instrument, studio, réservation, apprendre">
      <meta name="author" content="PPE SoundMe">
    <link rel="shortcut icon" href="photos/logo_onglet.ico">      
        <!-- Feuille de style  -->

      <link rel="stylesheet" href="css/default.css">

       <!-- Feuilles de style  -->
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

         <!-- Bibliothèques JQuery  -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
        
        <!-- Titre  -->
      <title>Inscription</title> 
</head>

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