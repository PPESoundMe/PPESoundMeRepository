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

$pdo = new PDO('mysql:host=localhost;dbname=soundme','root','');

// echo $_SESSION['id_utilisateur'];

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
    $getid = intval($_GET['id_utilisateur']);
    $requser = $pdo->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur=?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();

    $requser = $pdo->prepare("SELECT * FROM Utilisateur WHERE id_utilisateur=?");
    $requser->execute(array($_SESSION['id_utilisateur']));
    $user = $requser->fetch();

    if(isset($_POST['forminscription']) AND (!empty($_POST['activite']) OR !empty($_POST['niveau']) OR !empty($_POST['instrument']) OR !empty($_POST['style']) OR !empty($_POST['adresse'])))
    {
           if(isset($_POST['adress']) AND !empty($_POST['adress']) AND $_POST['adress']!=$userinfo['adresse'])
            {
                $adress = htmlspecialchars($_POST['adress']);
                $insertadress = $pdo->prepare("UPDATE Utilisateur SET adresse = ? WHERE id_utilisateur = ?");
                $insertadress->execute(array($adress,$userinfo['id_utilisateur']));
                
            }  
			
			if(!empty($_POST['activite']))
			{
				foreach($_POST['activite'] as $value)
				{
					$req_activite = $pdo->prepare("INSERT INTO profil_musical(id_utilisateur,activite) VALUES (?,?)");
					$req_activite->execute(array($userinfo['id_utilisateur'],$value));
				}
			}
            
			if(!empty($_POST['instrument']))
			{
				foreach($_POST['instrument'] as $value)
				{
					$req_instrument = $pdo->prepare("INSERT INTO instrument(nom_instrument,id_utilisateur) VALUES (?,?)");
					$req_instrument->execute(array($value,$userinfo['id_utilisateur']));
				}
			}
			
			if(!empty($_POST['style']))
			{
				foreach($_POST['style'] as $value)
				{
					$req_style = $pdo->prepare("INSERT INTO style_musical(style,id_utilisateur) VALUES (?,?)");
					$req_style->execute(array($value,$userinfo['id_utilisateur']));
				}
			}
			
			if(isset($_POST['objectifs']) AND !empty($_POST['objectifs']) AND $_POST['objectifs']!=$userinfo['objectifs'])
            {
                $objectifs = htmlspecialchars($_POST['objectifs']);
                $insertobjectif = $pdo->prepare("UPDATE Utilisateur SET objectifs = ? WHERE id_utilisateur = ?");
                $insertobjectif->execute(array($objectifs,$userinfo['id_utilisateur']));  
            }
			
			if(isset($_POST['niveau']) AND !empty($_POST['niveau']) AND $_POST['niveau']!=$userinfo['niveau'])
            {
                $niveau = htmlspecialchars($_POST['niveau']);
                $insertniveau = $pdo->prepare("UPDATE Utilisateur SET niveau = ? WHERE id_utilisateur = ?");
                $insertniveau->execute(array($niveau,$userinfo['id_utilisateur']));
            }
			
			header("Location:profil.php?id_utilisateur=".$userinfo['id_utilisateur']);
    }


    


?>

<!-- Début HTML  -->
<html>
	<head>
		
	   <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="SoundMe Réseau Social">
        <meta name="keywords" content="SoundMe, music, rencontre, réseau, social, instrument, studio, réservation, apprendre">
        <meta name="author" content="PPE SoundMe">
        <link rel="shortcut icon" href="photos/logo_onglet.ico">
            
        <!-- Feuille de style  -->
        <!--<link rel="stylesheet" href="css/stylelogin.css"> -->
        <link rel="stylesheet" href="css/default.css">

         <!-- Feuilles de style  -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

         <!-- Bibliothèques JQuery  -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

        
        <!-- Titre  -->
	    <title>Inscription facultative</title> 
	</head>
	
	<body>
        
        
        <!-- Header logo  -->
       <header> 
                <figure>

                  
                    <a href="accueil.php" class="  "><img src="photos/noteblanche.png" alt="logoSoundMe"></a> 

                </figure>
            </header>
        
        
        <!-- Box d'inscriptino  -->
       <div class="container">

            <div class="box">
		<h1>Inscription facultative</h1>
        <h2 grey>Vous pouvez ignorer cette étape ou y revenir plus tard.</h2>
	
		
        <!-- Formulaire  -->         
            <!-- Profil musical  -->
            <form method="POST" action ="">
		
		<hr>
            <section>
                <h3>Profil musical</h3>
                <label for="prenom">Profil</label>
				
                <ol>
                    <li>
                        <input type="checkbox" id="chanteur" name="activite[]" value="chanteur">
                         <label for="chanteur">Chanteur</label>
                    </li>
                    <li>
                        <input type="checkbox" id="DJ" name="activite[]" value="DJ">
                         <label for="DJ">DJ</label>
                    </li>

                    <li>
                         <input type="checkbox" id="musicien" name="activite[]" value="musicien">
                         <label for="musicien">Musicien</label>
                    </li>
                </ol>
				
            </section>
         
            <!-- Niveau  -->
            <section>
                    <hr>
                    <h3>Niveau</h3> 
                        <ol>
                    <li>
                        <input type="checkbox" id="debutant" name="niveau" value="debutant">
                         <label for="debutant">Débutant</label>
                    </li>
                    <li>
                        <input type="checkbox" id="intermediaire" name="niveau" value="intermediaire">
                         <label for="intermediaire">Intermédiaire</label>
                    </li>

                    <li>
                         <input type="checkbox" id="avance" name="niveau" value="avance">
                         <label for="avance">Avancé</label>
                    </li>
                    <li>
                         <input type="checkbox" id="professionel" name="niveau" value="professionnel">
                         <label for="professionel">Professionel</label>
                    </li>
                </ol>
                </section>
            
                
            <!-- Instruments  -->
                <section>
				    <hr>
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
                    

            </section>
				
<!-- Styles de musiques favoris  -->
            <section>
                <hr>
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
                             <label for="Dubstep">Classique</label></td>
                            
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
            </section>
        
				
<!-- Adresse ou arrondissement  -->
                <section>
                    <hr>
                    <h3>Adresse ou arondissement </h3> 
                    <p>
						<!--<input type="adress" placeholder="Votre adresse" id="adresse" name="adresse" />-->
                        <input type="text" id="adress" class="validate" name="adress" value="<?php echo $userinfo['adresse']; ?>">
                       <!-- <label for="icon_prefix">Adresse</label>-->
                        <span id="place-id"></span>
                        <span id="place-address"></span>
                    </p>
                 
                    
                </section>
						
                	
<!-- Ce que vous attendez de soundme  -->
                <!--    <hr>-->
                   <h3>Objectifs</h3>
                    <section id="objectifs">
                   <!-- <div class="lol"><textarea name="objectifs" id="objectifs" rows="10" cols="50" placeholder="Que recherches-tu ?"></textarea></div>
		                <div class="row">-->
						
					

        <div class="input-field col s12">
          <i class="material-icons prefix">mode_edit</i>
          <textarea id="icon_prefix2" name="objectifs" class="materialize-textarea" value="<?php echo $userinfo['objectifs']; ?>"></textarea>
          <label for="icon_prefix2">Que recherches-tu ?</label>
        </div>
      </div>

  </div>
                    </section>	
	   
  <section>             
            <!-- Bouton validation  -->
			<input id="valide" type="submit" name="forminscription" value="Confirmer" />
                    
            <!-- Bouton ignorer  -->
            
            <a id="valide" href="profil.php?id_utilisateur=<?php //echo $_SESSION['id_utilisateur']; ?>">Ignorer cette étape</a>
       
</section>
        </form>
	   </div>
     </div>
 </div>

        <script>
    function find_adress() {

        var input = document.getElementById('adress');

        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
          
          var place = autocomplete.getPlace();

          document.getElementById('place-id').textContent = place.place_id;
          document.getElementById('place-address').textContent =
              place.formatted_address;
        });
      }
    </script>   
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBesfXDKzNyZPcB2Nr-F8DoeFg2kCCDbiQ&libraries=places&callback=find_adress"
        async defer></script>

	</body>
</html>

<?php
} 
?>