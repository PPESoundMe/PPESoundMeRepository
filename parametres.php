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

if(isset($_SESSION['id_utilisateur']))
{
	$requser = $pdo->prepare("SELECT * FROM Utilisateur WHERE id_utilisateur=?");
	$requser->execute(array($_SESSION['id_utilisateur']));
	$user = $requser->fetch();
	
	if(isset($_POST['mdp']) AND !empty($_POST['mdp']) AND isset($_POST['nouvmdp']) AND !empty($_POST['nouvmdp']) AND isset($_POST['nouvmdp2']) AND !empty($_POST['nouvmdp2']))
	{
		$mdp = sha1($_POST['mdp']);
		$nouvmdp = sha1($_POST['nouvmdp']);
		$nouvmdp2 = sha1($_POST['nouvmdp2']);
		
		if($mdp == $user['mdp'])
		{
			if($nouvmdp == $nouvmdp2)
			{
				$insertmdp=$pdo->prepare("UPDATE Utilisateur SET mdp=? WHERE id_utilisateur=?");
				$insertmdp->execute(array($nouvmdp,$_SESSION['id_utilisateur']));
				header('Location:profil.php?id_utilisateur='.$_SESSION['id_utilisateur']);
			}
			else
			{
				$message = "Les deux nouveaux mots de passe doivent être identiques !";
			}
		}
		else
		{
			$message = "Le mot de passe actuel est incorrect";
		}
	}
	else
	{ 
		$message = "Veuillez remplir tous les champs !";
	}
	
	if(isset($_POST['nouvnom']) AND !empty($_POST['nouvnom']) AND $_POST['nouvnom']!=$user['nom'])
	{
		$nouvnom = htmlspecialchars($_POST['nouvnom']);
		$insertnom = $pdo->prepare("UPDATE Utilisateur SET nom = ? WHERE id_utilisateur = ?");
		$insertnom->execute(array($nouvnom,$_SESSION['id_utilisateur']));
		header('Location:profil.php?id_utilisateur='.$_SESSION['id_utilisateur']);
	}
	
	if(isset($_POST['nouvprenom']) AND !empty($_POST['nouvprenom']) AND $_POST['nouvprenom']!=$user['prenom'])
	{
		$nouvprenom = htmlspecialchars($_POST['nouvprenom']);
		$insertprenom = $pdo->prepare("UPDATE Utilisateur SET prenom = ? WHERE id_utilisateur = ?");
		$insertprenom->execute(array($nouvprenom,$_SESSION['id_utilisateur']));
		header('Location:profil.php?id_utilisateur='.$_SESSION['id_utilisateur']);
	}
	
	if(isset($_POST['nouvdate']) AND !empty($_POST['nouvdate']) AND $_POST['nouvdate']!=$user['age'])
	{
		$nouvdate = htmlspecialchars($_POST['nouvdate']);
		$insertdate = $pdo->prepare("UPDATE Utilisateur SET age = ? WHERE id_utilisateur = ?");
		$insertdate->execute(array($nouvdate,$_SESSION['id_utilisateur']));
		header('Location:profil.php?id_utilisateur='.$_SESSION['id_utilisateur']);
	}

	if(isset($_POST['adress']) AND !empty($_POST['adress']) AND $_POST['adress']!=$user['adresse'])
	{
		$adress = htmlspecialchars($_POST['adress']);
		$insertadress = $pdo->prepare("UPDATE Utilisateur SET adresse = ? WHERE id_utilisateur = ?");
		$insertadress->execute(array($adress,$_SESSION['id_utilisateur']));
		header('Location:profil.php?id_utilisateur='.$_SESSION['id_utilisateur']);
	}
}

?>

<html>
	<head>

	
		<meta charset="utf-8">
	   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<meta name="description" content="SoundMe Réseau Social">
	    <meta name="keywords" content="SoundMe, music, rencontre, réseau, social, instrument, studio, réservation, apprendre, parametres">
	    <meta name="author" content="PPE SoundMe">
      <link rel="shortcut icon" href="photos/logo_onglet.ico">
        
        <!-- Feuilles de style  -->
	    <link rel="stylesheet" href="style/css/styleparametre.css">
        <link rel="stylesheet" href="style/css/stylenavbar.css">
        <link href="style/css/hover-min.css" rel="stylesheet">
        
        <!-- Ajout du js pour la navbar  -->
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(e){
                $('.has-sub').click(function(){
                    $(this).toggleClass('tap');
                })
            })
        </script>
	    
        <!-- Titre  -->
	    <title>Paramètres - SoundMe</title>    
	</head>
	
	<body>
        <!-- Headerlogo  -->
        <header> 
            <figure>
                <img src="style/photos/noteblanche.png" alt="logoSoundMe">
            </figure>
        </header>
        
        
        <!-- Début du menu sur le côté  -->
        <aside>
            
            <!-- Barre de recherche  -->
            <nav class="main-nav">
                <form action="">
                    <input id="barnav" type = "text" name="" placeholder="RECHERCHE...">
                </form>
                <ul class="main-nav-ul">
                    
                    <li class="has-sub"><a href="profil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Profil<span class="sub-arrow"></span></a>
                        <ul>
                            <li><a href="#">Mes groupes</a></li>
                            <li><a href="#">Mes abonnés</a></li>
                            <li><a href="#">Mes événements</a></li>
                        </ul>

                    </li>
                    <li><a href="actualite.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Actualités</a></li>
                    <li><a href="carte.php">SoundMap</a></li>
                    <li class="has-sub"><a href="#">Messagerie<span class="sub-arrow"></span></a>
                        <ul>
                            <li><a href="envoi.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Envoyer un message</a></li>
                            <li><a href="reception.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Mes messages</a></li>
                        </ul>

                    </li>
                    <li><a href="#">Mes réservations</a></li>
                    <li><a href="parametres.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Paramètres</a></li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                
                </ul>
            
            </nav>
        </aside>
        
        
         <!-- Début du main  -->
	   <main>
		<h1>Paramètres du compte</h1>		
		
           <hr>
		<h2>Changer le mot de passe </h2>
		
		<form method="POST" id="changemdp" action="">
		
		<?php if(isset($message)) {echo $message;}?>
		
			<table>
                <tr>
                    
                    <td><label>Mot de passe actuel : </label></td>
                    <td><input type="password" name="mdp"/></td>
            
                </tr>
                <td><label>Nouveau mot de passe : </label></td>
                <td><input type="password" name="nouvmdp" /></td>
           
                <tr>
                    <td><label>Confirmer le nouveau mot de passe : </label></td>
                    <td><input type="password" name="nouvmdp2" /></td>
                </tr>
           
                <tr>
                    <td><input type="submit" value="Enregistrer les modifications" /></td>
                </tr>
            </table>
				
		</form>
           
           <hr>
		
           <section>
		<h2> Informations générales </h2>
		
		<form method="POST" action ="" id="infogenerales">
		  <table>
              <tr>
                  <td><label>Nom : </label></td>
                  <td><input type="text" name="nouvnom" placeholder="Nom" value="<?php echo $user['nom']; ?>" /></td>
            
              </tr>
              
              <tr>
                  <td><label>Prénom : </label></td>
                  <td><input type="text" name="nouvprenom" placeholder="Prenom" value="<?php echo $user['prenom']; ?>" /></td>
            
              </tr>
			<tr>
                <td><label>Date de naissance : </label></td>
                <td><input type="date"  id="nouvdate" name="nouvdate" placeholder="Date de naissance" value="<?php echo $user['age']; ?>" /></td>
              </tr>
			
              <tr>
                  <td><input type="submit" value="Enregistrer les modifications" /></td>
              </tr>
            </table>
            
		</form>
           </section>
           
			<section>
		<h2>Adresse</h2>
		<form method="POST" action ="">
			<table>
              <tr>
                <td><label>Adresse : </label></td>
                <td><input type="text" id="adress" class="controls" name="adress" placeholder="Adresse" value="<?php echo $user['adresse']; ?>"></td>
              </tr>
              <tr>
              	<td><span id="place-id"></span></td>
      			<td><span id="place-address"></span></td>
      		  </tr>
			
              <tr>
                  <td><input type="submit" value="Enregistrer l'adresse" /></td>
              </tr>
            </table>
            
		</form>
    		</section>

           <section>
			
               <hr>
		<h2> Informations personnelles </h2>
		
		<form method="POST" action ="">
		
			<h3>Profil musical</h3>
            
            <ol>
                <li>
                    <input type="checkbox" id="chanteur" name="activite" value="chanteur">
			         <label for="chanteur">Chanteur</label>
                </li>
			<li>
                <input type="checkbox" id="DJ" name="activite" value="DJ">
			     <label for="DJ">DJ</label>
                </li>
                
                <li>
			         <input type="checkbox" id="musicien" name="activite" value="musicien">
			         <label for="musicien">Musicien</label>
                </li>
            </ol>
            
			<h3>Niveau</h3> 
			<select name="niveau" size="1">
				<option>Débutant <option>Intermédiaire <option>Avancé <option>Professionnel 
			</select>
				 				 
			 <h3>Styles musicaux favoris </h3> 
            <ul>
                
                <li><input type="checkbox" name="rock" value="rock">Rock</li>
                <li><input type="checkbox" name="hiphop" value="hiphop">Hip-Hop</li>
                <li><input type="checkbox" name="pop" value="pop">Pop</li>
                <li><input type="checkbox" name="jazz" value="jazz">Jazz</li>
                <li><input type="checkbox" name="rap" value="rap">Rap</li>
                <li><input type="checkbox" name="rnb" value="rnb">R'n'B</li>
                <li><input type="checkbox" name="metal" value="metal">Metal</li>
                <li><input type="checkbox" name="classique" value="classique">Musique classique</li>
                <li><input type="checkbox" name="house" value="house">House</li>
                <li><input type="checkbox" name="opera" value="opera">Opéra</li>
                <li><input type="checkbox" name="dubstep" value="dubstep">Dubstep</li>
                <li><input type="checkbox" name="techno" value="techno">Techno</li>
                <li><input type="checkbox" name="transe" value="transe">Transe</li>
                <li><input type="checkbox" name="country" value="country">Country</li>
            </ul>
        </form>

</section>
           <hr>
           
			<h3>Objectifs</h3>
           <section id="objectifs">
               <div class="lol"><textarea name="objectifs" id="objectifs" rows="10" cols="50" placeholder="Qu'attendez-vous de SoundMe ?"></textarea></div>
			 
               <div class="lol"><input type="button" value=" Enregistrer les modifications " id="enregistrer"></div>
           </section>
		
		</main>	
	
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