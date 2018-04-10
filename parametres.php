<?php //include "../inc/dbinfo.inc"; ?>

<?php
session_start();
ini_set('display_errors', 'On');
error_reporting(E_ALL);
/*$dbhost = DB_SERVER;
$dbport = DB_PORT;
$dbname = DB_DATABASE;
$charset = 'utf8' ;
$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$username = DB_USERNAME;
$password = DB_PASSWORD;

$pdo = new PDO($dsn, $username, $password);*/

$pdo = new PDO('mysql:host=localhost;dbname=soundme', 'root', 'root');


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
			$message = "Le mot de passe actuel est incorrect !";
		}
	}
	else
	{ 
		$message = "Veuillez remplir tous les champs !";
	}
	

  //PHOTO DE PROFIL
if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
    {

      $tailleMax = 2097152; 
      $extensionValides = array('jpg','jpeg','gif','png');
      if($_FILES['avatar']['size']<= $tailleMax)
      {
        $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'],'.'),1));
        if(in_array($extensionUpload, $extensionValides))
        {
          $chemin = "membres/avatar/".$_SESSION['id_utilisateur'].".".$extensionUpload;
          $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$chemin);
          if($resultat)
          {
            $updateavatar = $pdo->prepare('UPDATE Utilisateur SET avatar = :avatar WHERE id_utilisateur = :id_utilisateur');
            $updateavatar->execute(array(
                'avatar' => $_SESSION['id_utilisateur'].".".$extensionUpload,
                'id_utilisateur'=> $_SESSION['id_utilisateur']
              ));
      

            header("Location:profil.php?id_utilisateur=".$_SESSION['id_utilisateur']);

          }
          else
          {
            $message =  "Erreur pendant l'importation de la photo !";
          }
        }
        else
        {
          $message = "Votre photo de profil doit être au format jpg, jpeg, gif ou png !";
        }
      }
      else
      {
        $message =  "Votre photo de profil ne doit pas dépasser 2Mo !";
      }
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

		$reqstyle = $pdo->prepare('SELECT * FROM style_musical WHERE id_utilisateur=?');
		$reqstyle->execute(array($_SESSION['id_utilisateur']));
		$style = $reqstyle->fetch();
		
		/*if (isset($_POST[profil_musical])) {  // SI ma_radio A BIEN ÉTÉ POSTÉ
		if ($_POST["ma_radio"] == "1") { // SI ma_radio EST ÉGAL À 1 
         echo "checked"; // je check ma radio */
      
}
		
?>

<html>
	<head>

	
		<meta charset="utf-8">
    <link rel="shortcut icon" href="photos/logo_onglet.ico">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="SoundMe Réseau Social">
      <meta name="keywords" content="SoundMe, music, rencontre, réseau, social, instrument, studio, réservation, apprendre, parametres">
      <meta name="author" content="PPE SoundMe">
        
        <!-- Feuilles de style  -->
    
        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="css/styleparametre.css">
   
        
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize/materialize.css"  media="screen,projection"/>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

         <!-- Bibliothèques JQuery  -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

         <!-- Compiled and minified CSS -->

      <!-- Compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
	    
        <!-- Titre  -->
	    <title>Paramètres - SoundMe</title>    
	</head>
	


 <header>

      <!-- NAVBAR DU HAUT  -->
  <nav class="white ">
  
    <div class="nav-wrapper ">
        <a href="#!" class="brand-logo right"><img src="photos/horizontal.png" width="600" alt=""></a>
 
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <form>
        <div class="input-field">
          <input id="search" type="search" required>
          <label class="label-icon" for="search"><i class="material-icons red-text text-accent-4">search</i></label>
        
        </div>
      </form>
      </ul>
    </div>
      </nav>
 </header>
   
   <body>     
     



      <!-- NAVBAR DU BAS  -->   
    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li><div class="user-view">
          <div class="background">
            <img src="photos/fond.jpg">
          </div>
          
          <a href="profil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><img class="circle hoverable" src="membres/avatar/<?php if($user['avatar'] == NULL) { echo "default.png"; } else {  echo $user['avatar']; } ?>"></a>
          <a href="#name"><span class="white-text name"><?php echo $user['prenom'] ; echo(" "); echo $user['nom'] ; ?></span></a>
          <a href="#email"><span class="white-text email"><?php echo $user['email'] ;?></span></a>

        </div></li>

        <ul class="collapsible collapsible-accordion">
              <li>
                <a class="collapsible-header">Mon espace<i class="material-icons">arrow_drop_down</i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="profil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">person</i>Mon profil</a></li>
                    <li><a href="actualite.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">message</i>Messagerie</a></li>
                    <li><a href="actualite.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">group_add</i>Mes abonnés</a></li>



                  </ul>
                </div>
              </li>
            </ul>
        <li><a href="actualite.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">language</i>Actualités</a></li>
        <li><a href="#!"><i class="material-icons">location_on</i>Soundmap</a></li>
      <li><a href="membres.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">favorite</i>SoundFamily</a></li>

        <li><a href="#!"><i class="material-icons">headset</i>Mes réservations</a></li>
        <li><a href="parametres.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">settings</i>Paramètres</a></li>
        <li><a href="accueil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">settings_power</i>Déconnexion</a></li>
        
      </ul>
            
        
        
         <!-- Début du main  -->
	   <main>
      <div class="container">
		<h1>Paramètres du compte</h1>		
		
    <hr>
          <section>
    <h2><i class="material-icons prefix">photo</i> Changer la photo de profil</h2>

    <form method="POST" action ="" enctype="multipart/form-data">
      
       
     <div class="erreur">
      <?php if(isset($message)) {echo $message;}?>
    </div>





          <div class="row">
            <div class="input-field col s6">
               <div class="file-field input-field">
                <div class="btn">
                <span>Fichier</span>
           <input type="file" name="avatar" />
      
            
         </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Charger une photo"><br></br>

              </div>
            </div>  
                </div>
            </div>

            <div class="row">
              <div class="input-field col s6">   
                <button id="valide" class="btn waves-effect waves-light red accent-3" type="submit" value="Enregistrer l'avatar">Charger la photo
                <i class="material-icons right">send</i>
             </button>
              </div>
            </div>  

          </form>
        </section>

        <hr>
		<h2><i class="material-icons prefix">security</i> Changer le mot de passe </h2>
		
		<form method="POST" id="changemdp" action="" class="col s12" >
		
     
              <div class="row">
                 <div class="input-field col s6">
                      <input   id="mdpactuel" type="password" class="validate" name="mdp" /> 
                      <label for="mdpactuel">Mot de passe actuel</label>
                  </div>
              </div>

              <div class="row">
                 <div class="input-field col s6">
                      <input  id="mdpactuel" type="password" class="validate" name="nouvmdp" /> 
                      <label for="mdpactuel">Nouveau mot de passe</label>
                  </div>
                  <div class="input-field col s6">
                      <input  id="mdpactuel" type="password" class="validate" name="nouvmdp2" /> 
                      <label for="mdpactuel">Confirmer le nouveau mot de passe</label>
                  </div>
              </div>

              <div class="row">
              <div class="input-field col s6">   
                <button id="valide" class="btn waves-effect waves-light red accent-3" type="submit" value="Enregistrer les modifications">Enregistrer le mot de passe
                <i class="material-icons right">send</i>
             </button>
              </div>
            </div>         
      </form>


           
           <hr>
		
           <section>
		<h2> <i class="material-icons prefix">person</i> Informations générales </h2>
		
		<form method="POST" action ="" id="infogenerales">

             
                  <form class="col s12">
                    <div class="row">
                      <div class="input-field col s6">
                        
                        <input name="nouvprenom" placeholder="Prénom" id="prenom" type="text" class="validate" value="<?php echo $user['prenom']; ?>" /> 
                        <label for="prenom">Prénom</label>
                      </div>
                      <div class="input-field col s6">
                        <input id="nom" type="text" class="validate" name="nouvnom" placeholder="Nom" value="<?php echo $user['nom']; ?>">
                        <label for="nom">Last Name</label>
                      </div>
                    </div>
              
	              <label>Date de naissance : </label></td>
                <input type="date"  id="nouvdate" name="nouvdate" placeholder="Date de naissance" value="<?php echo $user['age']; ?>" />
                <!--Bouton valider-->

             <div class="row">
              <div class="input-field col s6">   
                <button id="valide" class="btn waves-effect waves-light red accent-3" type="submit" value="Enregistrer les modifications">Enregistrer les modifications
                <i class="material-icons right">send</i>
             </button>
              </div>
            </div>        
            
		  </form>
           </section>
           
			<section>
		<h2><i class="material-icons prefix">home</i> Adresse</h2>

		<form method="POST" action ="">
          <div class="row">
            <div class="input-field col s6">
                  <i class="material-icons prefix">home</i>
                    <input type="text" id="icon_prefix" class="validate" name="adress" value="<?php echo $user['adresse']; ?>">
                    <label for="icon_prefix">Adresse</label>
              	     <span id="place-id"></span>
      			         <span id="place-address"></span>

                  
                </div>
            </div>

            <div class="row">
              <div class="input-field col s6">   
                <button id="valide" class="btn waves-effect waves-light red accent-3" type="submit" value="Enregistrer l'adresse">Enregistrer l'adresse
                <i class="material-icons right">send</i>
             </button>
              </div>
            </div>  

		      </form>
    		</section>

    


           <section>
			
               <hr>
		<h2><i class="material-icons prefix">music_note</i> Informations personnelles </h2>
		
		<form method="POST" action ="">
		
					<input type="checkbox" id="chanteur" name="activite" value="chanteur">
					<label for="chanteur">Chanteur</label>
				
					<input type="checkbox" id="DJ" name="activite" value="DJ">
					<label for="DJ">DJ</label>
				
					<input type="checkbox" id="musicien" name="activite" value="musicien">
					<label for="musicien">Musicien</label>
				
		
		</form>
	
  <!-- Dossier Javascript -->
  <script type="text/javascript">
     $(document).ready(function(){
      $('.sidenav').sidenav();
       $('.sidenav').sidenav('methodName');
    $('.sidenav').sidenav('methodName', paramName);

      });
  $(document).ready(function(){
    $('.modal').modal();
  });
  </script>
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