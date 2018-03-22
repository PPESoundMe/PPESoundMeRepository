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

$pdo = new PDO('mysql:host=localhost;dbname=soundme', 'root', '');

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

	<head>
		<title>Carte SoundMe</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<!-- Elément Google Maps indiquant que la carte doit être affiché en plein écran et
		qu'elle ne peut pas être redimensionnée par l'utilisateur -->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<!-- Inclusion de l'API Google MAPS -->
		<!-- Le paramètre "sensor" indique si cette application utilise détecteur pour déterminer la position de l'utilisateur -->
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBesfXDKzNyZPcB2Nr-F8DoeFg2kCCDbiQ"
  type="text/javascript"></script>
		<script type="text/javascript">
			function initialiser() {
				var latlng = new google.maps.LatLng(48.858, 2.333333);
				//objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant de définir des options d'affichage de notre carte
				var options = {
					center: latlng,
					zoom: 12, // de 0 à 20 (bornes comprises)
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				
				//constructeur de la carte qui prend en paramêtre le conteneur HTML dans lequel la carte doit s'afficher et les options
				var carte = new google.maps.Map(document.getElementById("carte"), options);

				//création du marqueur
				var marqueur_ecole = new google.maps.Marker({
					position: new google.maps.LatLng(48.85188369999999, 2.2863605999999663),
					map: carte
				});

				google.maps.event.addListener(marqueur_ecole, 'click', function() {
					document.location.href="http://www.ece.fr/ecole-ingenieur/";
				});

				var marqueur_studio1 = new google.maps.Marker({
					position: new google.maps.LatLng(48.8355355, 2.2866079000000354),
					map: carte,
					//icon: "logo_localquinze.png"
				});
			}

			function mapMarkAdress (address) {
			    mapGeocoder = new GClientGeocoder();
			    mapGeocoder.getLatLng(address, function(latLng) {
        			if (latLng) mapMarkLatLng(latLng);
    			});
			}
			mapMarkAdress('2 rue Corbon, 75015, Paris, France');

		</script>
	</head>

	<body onload="initialiser()">
		<div id="carte" style="width:80%; height:80%"></div>
	</body>
</html>