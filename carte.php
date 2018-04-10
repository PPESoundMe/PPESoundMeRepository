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

echo "test";

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
	// Table Utilisateur
    $getid = intval($_GET['id_utilisateur']);
    $requser = $pdo->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur=?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();


    // $reponse = $pdo->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur=?');

  /* $bdd_profil = $pdo->query('SELECT * FROM profil_musical');
    $bdd_niveau = $pdo->query('SELECT * FROM niveau');
    $bdd_instrument = $pdo->query('SELECT * FROM instrument');
    $bdd_style = $pdo->query('SELECT * FROM style_musical');
*/
	echo 'hello';
    if(isset($_POST['formrecherche']) AND !empty($_POST['activite']) OR !empty($_POST['niveau']) OR !empty($_POST['instrument']) OR !empty($_POST['style']))
    {
    	echo 'hello2';
			  

			  	$prefMus = $_POST['activite'];
			  	$niv = $_POST['niveau'];
			  	$instr = $_POST['instrument'];
			 	$styl = $_POST['style'];

			  	echo 'hello3';
				
					echo 'hello4';
					$resultatFinalProfil = array();
					$resultatFinalNiveau = array();
					$resultatFinalInstrument = array();
					$resultatFinalStyle = array();
					$resultatFinalIntersect = array();

					$resultatIntersectProfNiv = array();
					$resultatIntersectNivInstr = array();
					$resultatIntersectInstrStyle = array();

					$resultatIntersectProfNivInstr = array();
					$resultatIntersectNivInstrStyle = array();

					foreach($prefMus as $valuePref){
						$resultatsProfil = $pdo->query("SELECT id_utilisateur FROM profil_musical WHERE activite = '$valuePref'");

						while($row = $resultatsProfil->fetch(PDO::FETCH_ASSOC)) {
							array_push($resultatFinalProfil, $row['id_utilisateur']);
						}
					}
					echo "Profil";
					print_r($resultatFinalProfil) ; 



					$resultatsNiveau = $pdo->query("SELECT id_utilisateur FROM utilisateur WHERE niveau = '$niv'");

					while ($row = $resultatsNiveau->fetch(PDO::FETCH_ASSOC)) {
						array_push($resultatFinalNiveau, $row['id_utilisateur']);
					}
				
					echo "Niveau";
					print_r($resultatFinalNiveau) ; 
		

					foreach($instr as $valueInstr){
						$resultatsInstrument = $pdo->query("SELECT id_utilisateur FROM instrument WHERE nom_instrument = '$valueInstr'");

						while($row = $resultatsInstrument->fetch(PDO::FETCH_ASSOC)) {
							array_push($resultatFinalInstrument, $row['id_utilisateur']);
						}
					}
					echo "Instruments";
					print_r($resultatFinalInstrument) ;


					foreach($styl as $valueStyle){
						$resultatsStyle = $pdo->query("SELECT id_utilisateur FROM style_musical WHERE style = '$valueStyle'");

						while($row = $resultatsStyle->fetch(PDO::FETCH_ASSOC)) {
							array_push($resultatFinalStyle, $row['id_utilisateur']);
						}
					}
					echo "Styles";
					print_r($resultatFinalStyle) ;


					echo "Intersect";
					$resultatIntersectProfNiv = array_intersect($resultatFinalStyle, $resultatFinalInstrument);
					$resultatIntersectNivInstr = array_intersect($resultatFinalNiveau, $resultatFinalInstrument);
					$resultatIntersectInstrStyle = array_intersect($resultatFinalInstrument, $resultatFinalStyle);

					$resultatIntersectProfNivInstr = array_intersect($resultatIntersectProfNiv, $resultatIntersectNivInstr);
					$resultatIntersectNivInstrStyle = array_intersect($resultatIntersectNivInstr, $resultatIntersectInstrStyle);

					$resultatFinalIntersect = array_intersect($resultatIntersectProfNivInstr, $resultatIntersectNivInstrStyle);
					print_r($resultatFinalIntersect);

				
					    		
	}

}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

	<head>
		<title>SoundMap</title>
		<link rel="shortcut icon" href="photos/logo_onglet.ico">
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
		<div id="carte" style="width:50%; height:50%"></div>

	</body>
		<form method="POST" action="">
		<h3>Profil musical</h3>

        <input type="checkbox" id="chanteur" name="activite[]" value="chanteur">
        <label for="chanteur">Chanteur</label>
   
        <input type="checkbox" id="DJ" name="activite[]" value="DJ">
        <label for="DJ">DJ</label>
    
        <input type="checkbox" id="musicien" name="activite[]" value="musicien">
        <label for="musicien">Musicien</label>

          
        <h3>Niveau</h3> 
	        <input type="radio" id="debutant" name="niveau" value="debutant">
	       	<label for="debutant">Débutant</label>

	        <input type="radio" id="intermediaire" name="niveau" value="intermediaire">
	        <label for="intermediaire">Intermédiaire</label>

	        <input type="radio" id="avance" name="niveau" value="avance">
	        <label for="avance">Avancé</label>

	        <input type="radio" id="professionel" name="niveau" value="professionnel">                                       
	        <label for="professionel">Professionel</label>

		    
		 <h3>Instruments</h3> 
          
            <table>
               <tr>
                   <td><input type="checkbox" id="Guitare" name="instrument[]" value="Guitare">
                     <label for="Guitare">Guitare </label></td>
                   
                   <td><input type="checkbox" id="Piano" name="instrument[]" value="Piano">
                     <label for="Piano">Piano</label></td>
                   
                   <td><input type="checkbox" id="Batterie" name="instrument[]" value="Batterie">
                     <label for="Batterie">Batterie</label></td>
               </tr>
               <tr>
                   <td><input type="checkbox" id="Basse" name="instrument[]" value="Basse">
                     <label for="Basse">Basse</label></td>
                   
                   <td><input type="checkbox" id="Violon" name="instrument[]" value="Violon">
                     <label for="Violon">Violon</label></td>
                   <td><input type="checkbox" id="Flûte" name="instrument[]" value="Flute">
                     <label for="Flûte">Flûte</label></td>
               </tr>
                
                <tr>
                   <td><input type="checkbox" id="Trompette" name="instrument[]" value="Trompette">
                     <label for="Trompette">Trompette</label></td>
                   
                   <td><input type="checkbox" id="Harpe" name="instrument[]" value="Harpe">
                     <label for="Harpe">Harpe</label></td>
                    
                   <td><input type="checkbox" id="Saxophone" name="instrument[]" value="Saxophone">
                     <label for="Saxophone">Saxophone</label></td>
               </tr>
                
                <tr>
                   <td><input type="checkbox" id="Violoncelle" name="instrument[]" value="Violoncelle">
                     <label for="Violoncelle">Violoncelle</label></td>
                   
                   <td><input type="checkbox" id="Triangle" name="instrument[]" value="Triangle">
                     <label for="Triangle">Triangle</label></td>
                    
                   <td><input type="checkbox" id="Contrebasse" name="instrument[]" value="Contrebasse">
                     <label for="Contrebasse">Contrebasse</label></td>
               </tr>
            </table>

		<h3>Styles musicaux favoris </h3> 
            <table>
                   <tr>

                       <td><input type="checkbox" id="Rock" name="style[]" value="Rock">
                         <label for="Rock">Rock </label></td>
                       
                       <td><input type="checkbox" id="HipHop" name="style[]" value="HipHop">
                         <label for="HipHop">Hip Hop</label></td>
                       
                       <td><input type="checkbox" id="Pop" name="style[]" value="Pop">
                         <label for="Pop">Pop</label></td>
                   </tr>
                   <tr>
                       <td><input type="checkbox" id="Jazz" name="style[]" value="Jazz">
                         <label for="Jazz">Jazz</label></td>
                       
                       <td><input type="checkbox" id="Rap" name="style[]" value="Rap">
                         <label for="Rap">Rap</label></td>

                       <td><input type="checkbox" id="RnB" name="style[]" value="R'n'B">
                         <label for="RnB">R'n'B</label></td>
                   </tr>
                    
                    <tr>
                       <td><input type="checkbox" id="Metal" name="style[]" value="Metal">
                         <label for="Metal">Metal</label></td>
                       
                       <td><input type="checkbox" id="Classique" name="style[]" value="Classique">
                         <label for="Classique">Classique</label></td>
                        
                       <td><input type="checkbox" id="House" name="style[]" value="House">              
                         <label for="House">House</label></td>
                   </tr>

                   <tr>
                       <td><input type="checkbox" id="Opera" name="style[]" value="Opera">
                         <label for="Opera">Opéra</label></td>                                                                        
                       
                       <td><input type="checkbox" id="Dubstep" name="style[]" value="Dubstep">
                         <label for="Dubstep">Dubstep</label></td>
                        
                       <td><input type="checkbox" id="Techno" name="style[]" value="Techno">
                         <label for="Techno">Techno</label></td>
                   </tr>
                    
                    <tr>

                       <td><input type="checkbox" id="Transe" name="style[]" value="Transe">
                         <label for="Transe">Transe</label></td>
                       
                       <td><input type="checkbox" id="Country" name="style[]" value="Country">
                         <label for="Country">Country</label></td>
        
                   </tr>
                </table>

            <input id="valide" type="submit" name="formrecherche" value="Valider la recherche" />
            </form>
            

</html>