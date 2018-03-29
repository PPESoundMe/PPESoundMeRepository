<?php // include "../inc/dbinfo.inc"; ?>

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

$pdo = new PDO('mysql:host=localhost;dbname=soundme', 'root', 'root');

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
	$getid = intval($_GET['id_utilisateur']);
	$requser = $pdo->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur=?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
}

?>

<html>
	<head>
		<title>Profil - SoundMe</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="photos/logo_onglet.ico">
	   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<meta name="description" content="SoundMe Réseau Social">
	    <meta name="keywords" content="SoundMe, music, rencontre, réseau, social, instrument, studio, réservation, apprendre, parametres">
	    <meta name="author" content="PPE SoundMe">
        
        <!-- Feuilles de style  -->
	  
        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="css/styleprofil.css">
   
        
    	<script type="text/javascript" src="js/materialize.min.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    	<!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
       <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

         <!-- Bibliothèques JQuery  -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

         <!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

    	<!-- Compiled and minified JavaScript -->
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
	</head>

	<header>
			<!-- NAVBAR DU HAUT  -->
	<nav class="transparent ">
  
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
		      <a href="profil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><img class="circle hoverable" src="photos/fond.jpg"></a>
		      <a href="#name"><span class="white-text name"><?php echo $userinfo['prenom'] ; echo(" "); echo $userinfo['nom'] ; ?></span></a>
		      <a href="#email"><span class="white-text email"><?php echo $userinfo['email'] ;?></span></a>
		    </div></li>

		    <ul class="collapsible collapsible-accordion">
		          <li>
		            <a class="collapsible-header">Mon espace<i class="material-icons">arrow_drop_down</i></a>
		            <div class="collapsible-body">
		              <ul>
		                <li><a href="actualite.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">music_note</i>Mes groupes</a></li>
		                <li><a href="actualite.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">group_add</i>Mes abonnés</a></li>
		                <li><a href=""><i class="material-icons">today</i>Mes événements</a></li>


		              </ul>
		            </div>
		          </li>
		        </ul>
		    <li><a href="actualite.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">language</i>Actualités</a></li>
		    <li><a href="#!"><i class="material-icons">location_on</i>Soundmap</a></li>
		 
		    <li><a href="#!"><i class="material-icons">headset</i>Mes réservations</a></li>
		    <li><a href="parametres.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">settings</i>Paramètres</a></li>
		    <li><a href="accueil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">settings_power</i>Déconnexion</a></li>
		    
		    <ul class="collapsible collapsible-accordion">
		          <li>
		            <a class="collapsible-header">Messagerie<i class="material-icons">message</i></a>
		            <div class="collapsible-body">
		              <ul>
		                <li><a href="#!">Envoyer un message</a></li>
		                <li><a href="#!">Mes messages</a></li>

		              </ul>
		            </div>
		          </li>
		        </ul>
		    <li><div class="divider"></div></li>
		    <li><a class="subheader">Subheader</a></li>
		    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
		  </ul>
		 

    


	<!-- CONTENU DE LA PAGE  -->		
	<main>
		<div class="container">
	
					<h1> <?php echo $userinfo['prenom']." ".$userinfo['nom'].""; ?> </h1>
					<img class="pp materialboxed" data-caption="Photo de <?php echo $userinfo['prenom']; ?>" src="photos/fond.jpg">


		
					<?php
						if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur']==$_SESSION['id_utilisateur'])
						{
						
						}
					?>
					<?php
						if(isset($_SESSION['id_utilisateur']) AND $_SESSION['id_utilisateur']!=$getid)
						{
							$isfollowingornot = $pdo->prepare('SELECT * FROM Abonnement WHERE id_abonne=? AND id_suivi=?');
							$isfollowingornot->execute(array($_SESSION['id_utilisateur'],$getid));
							$isfollowingornot = $isfollowingornot->rowCount();
							if($isfollowingornot==1)
							{
							?>
							<a href="follow.php?followedid=<?php echo $getid; ?>">Ne plus suivre cette personne</a>
							<?php
							}
							else
							{
							
						?>

						<a href="follow.php?followedid=<?php echo $getid; ?>">Suivre cette personne</a>
						
				
						<?php
						}
						}
					?>
	</div>
</main>
			
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
	</body>

<footer></footer>


</html>

