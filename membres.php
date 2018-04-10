<<<<<<< HEAD
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=soundme', 'root', 'root');

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
	$getid = intval($_GET['id_utilisateur']);
	$requser = $pdo->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur=?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
	
	$reqmembres = $pdo->query('SELECT * FROM utilisateur ORDER BY prenom');

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
        <link rel="stylesheet" href="css/.css">
   
        
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
          
		    <a href="profil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><img class="circle hoverable modal-trigger" src="membres/avatar/<?php if($userinfo['avatar'] == NULL) { echo "default.png"; } else {  echo $userinfo['avatar']; } ?>" href="#modal"></a>
          <a href="#name"><span class="white-text name"><?php echo $userinfo['prenom'] ; echo(" "); echo $userinfo['nom'] ; ?></span></a>
		      <a href="#email"><span class="white-text email"><?php echo $userinfo['email'] ;?></span></a>

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
		 

	<!-- CONTENU DE LA PAGE  -->		
	<main>
	


			<!-- CONTENU -->		

		<div class="container">
			<h1 class="left-align">Les membres</h1>

			<?php

				while($membres = $reqmembres->fetch())
				{
					
					if ($membres['id_utilisateur'] != $_SESSION['id_utilisateur'])
					{	
						?>
				<ul class="collection">
    			<li class="collection-item avatar">
						<img src="membres/avatar/<?php if($membres['avatar'] == NULL) { echo "default.png"; } else {  echo $membres['avatar']; } ?>" class="circle hoverable" /></div>
		      				<span class="title"><?php
							    echo $membres['prenom']." ".$membres['nom'];
								?></span>
		      				<p>Membre</p>

		      			<a href="#!" class="secondary-content"><i class="material-icons">group_add</i></a>
    			</li>
  			</ul>
  			<?php					
					}
				}
			
			?>
            
          </div>
				            
				
	 
	</main>
	</body>
	
</html>

<?php
}
=======
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=soundme', 'root', 'root');

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
	$getid = intval($_GET['id_utilisateur']);
	$requser = $pdo->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur=?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
	
	$reqmembres = $pdo->query('SELECT * FROM utilisateur ORDER BY prenom');

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
        <link rel="stylesheet" href="css/.css">
   
        
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
          
		    <a href="profil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><img class="circle hoverable modal-trigger" src="membres/avatar/<?php if($userinfo['avatar'] == NULL) { echo "default.png"; } else {  echo $userinfo['avatar']; } ?>" href="#modal"></a>
          <a href="#name"><span class="white-text name"><?php echo $userinfo['prenom'] ; echo(" "); echo $userinfo['nom'] ; ?></span></a>
		      <a href="#email"><span class="white-text email"><?php echo $userinfo['email'] ;?></span></a>

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
		 

	<!-- CONTENU DE LA PAGE  -->		
	<main>
	


			<!-- CONTENU -->		

		<div class="container">
			<h1 class="left-align">Les membres</h1>

			<?php

				while($membres = $reqmembres->fetch())
				{
					
					if ($membres['id_utilisateur'] != $_SESSION['id_utilisateur'])
					{	
						?>
				<ul class="collection">
    			<li class="collection-item avatar">
						<img src="membres/avatar/<?php if($membres['avatar'] == NULL) { echo "default.png"; } else {  echo $membres['avatar']; } ?>" class="circle" /></div>
		      				<span class="title"><?php
							    echo $membres['prenom']." ".$membres['nom'];
								?></span>
		      				<p>Membre</p>

		      			<a href="#!" class="secondary-content"><i class="material-icons">group_add</i></a>
    			</li>
  			</ul>
  			<?php					
					}
				}
			
			?>
            
          </div>
				            
				
	 
	</main>
	</body>
	
</html>

<?php
}
>>>>>>> ad81fa8440a73e8f0a4f60704dc887e94198cd36
?>