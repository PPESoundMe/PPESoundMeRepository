<<<<<<< HEAD
<?php // include "../inc/dbinfo.inc"; ?>

<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
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

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
	$getid = intval($_GET['id_utilisateur']);
	$requser = $pdo->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur=?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();


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
            echo ("Erreur pendant l'importation de la photo !");
          }
        }
        else
        {
          echo ("Votre photo de profil doit être au format jpg, jpeg, gif ou png !");
        }
      }
      else
      {
        echo  ("Votre photo de profil ne doit pas dépasser 2Mo !");
      }
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
		                <li><a href="actualite.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">music_note</i>Mes groupes</a></li>
		                <li><a href="membres.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">group_add</i>Mes abonnés</a></li>
		                <li><a href=""><i class="material-icons">today</i>Mes évènements</a></li>


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

		  		<!-- CONTENU -->
		  	    <div class="row"></div>
            

				 </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" placeholder="Charger une photo"><br></br>

    			 <div class="row">
				      <div class="col s4"><img src="membres/avatar/<?php if($userinfo['avatar'] == NULL) { echo "default.png"; } else {  echo $userinfo['avatar']; } ?>" class=" materialboxed pp left-align" data-caption="Photo de profil de <?php echo $userinfo['prenom']; ?>" /></div>
				      <div class="col s8">
				      	<h3> <?php echo $userinfo['prenom']." ".$userinfo['nom'].""; ?> </h3>
				      	<blockquote class="coucou">
				      	<ul class="grey-text">
					      <li><h6><i class=" tiny material-icons">cake</i> <?php echo $userinfo['age']; ?></h6></li>
					      <li><h6><i class=" tiny material-icons">group</i> Abonnés </h6></li>
					      <li><h6><i class=" tiny material-icons">message</i> Messages </h6></li>
					      <li><h6><i class=" tiny material-icons">settings</i> Paramètres </h6></li>
			  			</ul>
			  		</blockquote>

				      </div>

    			</div>

  <div class="card">

    <div class="card-tabs">
      <ul class="tabs tabs-fixed-width">
        <li class="tab"><a href="#test1" class="active">Photos</a></li>
        <li class="tab"><a href="#test2">Vidéos</a></li>
        <li class="tab"><a href="#test3">Enregistrements</a></li>
        <li class="tab"><a href="#test4">Évènements</a></li>
      </ul>
    </div>

    <div class="card-content grey lighten-4">
      <div id="test1">
		<?php
			$reqphotos = $pdo->prepare('SELECT * FROM actu WHERE id_utilisateur = ?');
			$reqphotos->execute(array($_SESSION['id_utilisateur']));
						
			while ($photos = $reqphotos->fetch())
			{
				if($photos['url']!=NULL)
				{
				$fichier = "membres/actus".$photos['url'];
				$extension = pathinfo($fichier, PATHINFO_EXTENSION);
					if($extension=='jpg' OR $extension=='jpeg' OR $extension=='gif' OR $extension=='png')
					{
					?>
						<img src="membres/actus/<?php echo $photos['url']; ?>" class="materialboxed" width="250" />
					<?php
					}
				}
			}
	    ?>
	  </div>
      <div id="test2">
	  <?php
			$reqvideos = $pdo->prepare('SELECT * FROM actu WHERE id_utilisateur = ?');
			$reqvideos->execute(array($_SESSION['id_utilisateur']));
						
			while ($videos = $reqvideos->fetch())
			{
				if($videos['url']!=NULL)
				{
				$fichier = "membres/actus".$videos['url'];
				$extension = pathinfo($fichier, PATHINFO_EXTENSION);
					if($extension=='mp4')
					{
					?>
						<video src="membres/actus/<?php echo $videos['url']; ?>" controls poster="membres/actus/<?php echo $videos['URL']; ?>.jpg" width="250"></video>
					<?php
					}
				}
			}
	    ?>
	  </div>
      <div id="test3">
	  <?php
			$reqenregistrement = $pdo->prepare('SELECT * FROM actu WHERE id_utilisateur = ?');
			$reqenregistrement->execute(array($_SESSION['id_utilisateur']));
						
			while ($enregistrements = $reqenregistrement->fetch())
			{
				if($enregistrements['url']!=NULL)
				{
				$fichier = "membres/actus".$enregistrements['url'];
				$extension = pathinfo($fichier, PATHINFO_EXTENSION);
					if($extension=='mp3')
					{
					?>
						<audio src="membres/actus/<?php echo $enregistrements['url']; ?>" controls></audio>
					<?php
					}
				}
			}
	    ?>
	  </div>
      <div id="test4">Evènements</div>
    </div>
  </div>
		
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

	  $(document).ready(function(){
    $('.tooltipped').tooltip();
  });
	</script>
	</body>

<footer></footer>

</html>

=======
<?php // include "../inc/dbinfo.inc"; ?>

<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
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

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
	$getid = intval($_GET['id_utilisateur']);
	$requser = $pdo->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur=?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();


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
            echo ("Erreur pendant l'importation de la photo !");
          }
        }
        else
        {
          echo ("Votre photo de profil doit être au format jpg, jpeg, gif ou png !");
        }
      }
      else
      {
        echo  ("Votre photo de profil ne doit pas dépasser 2Mo !");
      }
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
		                <li><a href="actualite.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">music_note</i>Mes groupes</a></li>
		                <li><a href="membres.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">group_add</i>Mes abonnés</a></li>
		                <li><a href=""><i class="material-icons">today</i>Mes évènements</a></li>


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

		  		<!-- CONTENU -->
		  	    <div class="row"></div>
            

				 </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" placeholder="Charger une photo"><br></br>

    			 <div class="row">
				      <div class="col s4"><img src="membres/avatar/<?php if($userinfo['avatar'] == NULL) { echo "default.png"; } else {  echo $userinfo['avatar']; } ?>" class=" materialboxed pp left-align" data-caption="Photo de profil de <?php echo $userinfo['prenom']; ?>" /></div>
				      <div class="col s8">
				      	<h3> <?php echo $userinfo['prenom']." ".$userinfo['nom'].""; ?> </h3>
				      	<blockquote class="coucou">
				      	<ul class="grey-text">
					      <li><h6><i class=" tiny material-icons">cake</i> <?php echo $userinfo['age']; ?></h6></li>
					      <li><h6><i class=" tiny material-icons">group</i> Abonnés </h6></li>
					      <li><h6><i class=" tiny material-icons">message</i> Messages </h6></li>
					      <li><h6><i class=" tiny material-icons">settings</i> Paramètres </h6></li>
			  			</ul>
			  		</blockquote>

				      </div>

    			</div>

  <div class="card">

    <div class="card-tabs">
      <ul class="tabs tabs-fixed-width">
        <li class="tab"><a href="#test1" class="active">Photos</a></li>
        <li class="tab"><a href="#test2">Vidéos</a></li>
        <li class="tab"><a href="#test3">Enregistrements</a></li>
        <li class="tab"><a href="#test4">Évènements</a></li>
      </ul>
    </div>

    <div class="card-content grey lighten-4">
      <div id="test1">
		<?php
			$reqphotos = $pdo->prepare('SELECT * FROM actu WHERE id_utilisateur = ?');
			$reqphotos->execute(array($_SESSION['id_utilisateur']));
						
			while ($photos = $reqphotos->fetch())
			{
				if($photos['url']!=NULL)
				{
				$fichier = "membres/actus".$photos['url'];
				$extension = pathinfo($fichier, PATHINFO_EXTENSION);
					if($extension=='jpg' OR $extension=='jpeg' OR $extension=='gif' OR $extension=='png')
					{
					?>
						<img src="membres/actus/<?php echo $photos['url']; ?>" class="materialboxed" width="250" />
					<?php
					}
				}
			}
	    ?>
	  </div>
      <div id="test2">
	  <?php
			$reqvideos = $pdo->prepare('SELECT * FROM actu WHERE id_utilisateur = ?');
			$reqvideos->execute(array($_SESSION['id_utilisateur']));
						
			while ($videos = $reqvideos->fetch())
			{
				if($videos['url']!=NULL)
				{
				$fichier = "membres/actus".$videos['url'];
				$extension = pathinfo($fichier, PATHINFO_EXTENSION);
					if($extension=='mp4')
					{
					?>
						<video src="membres/actus/<?php echo $videos['url']; ?>" controls poster="membres/actus/<?php echo $videos['URL']; ?>.jpg" width="250"></video>
					<?php
					}
				}
			}
	    ?>
	  </div>
      <div id="test3">
	  <?php
			$reqenregistrement = $pdo->prepare('SELECT * FROM actu WHERE id_utilisateur = ?');
			$reqenregistrement->execute(array($_SESSION['id_utilisateur']));
						
			while ($enregistrements = $reqenregistrement->fetch())
			{
				if($enregistrements['url']!=NULL)
				{
				$fichier = "membres/actus".$enregistrements['url'];
				$extension = pathinfo($fichier, PATHINFO_EXTENSION);
					if($extension=='mp3')
					{
					?>
						<audio src="membres/actus/<?php echo $enregistrements['url']; ?>" controls></audio>
					<?php
					}
				}
			}
	    ?>
	  </div>
      <div id="test4">Evènements</div>
    </div>
  </div>
		
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

	  $(document).ready(function(){
    $('.tooltipped').tooltip();
  });
	</script>
	</body>

<footer></footer>

</html>

>>>>>>> 4a97c592a0f1e1c05f66e9043c9b7d8947a5c91a
