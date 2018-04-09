<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
session_start();


$bdd = new PDO('mysql:host=localhost;dbname=soundme', 'root', '');




if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
	$getid = intval($_GET['id_utilisateur']);
	$requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id_utilisateur=?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
	
	
}

if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur']==$_SESSION['id_utilisateur'])
{
	$reqactus = $bdd->query('SELECT * FROM actu ORDER BY date_upload DESC ');



}

//STATUT
if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
	$getid = intval($_GET['id_utilisateur']);
	$requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id_utilisateur=?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
}

if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur']==$_SESSION['id_utilisateur'])
{
	if(isset($_POST['valider']))
	{
		$statut = $_POST['statut'];		
		
		if(!empty($statut))
		{
			$req= $bdd->prepare("INSERT INTO actu(id_utilisateur,description,date_upload) VALUES(?,?,CURRENT_TIMESTAMP)");
			$req->execute(array($_SESSION['id_utilisateur'],$statut));
			header("Location:actualite.php?id_utilisateur=".$_SESSION['id_utilisateur']);
			
		}
	}

}

//PHOTOS
if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
	$getid = intval($_GET['id_utilisateur']);
	$requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id_utilisateur=?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
}

if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur']==$_SESSION['id_utilisateur'])
{
	if(isset($_POST['valider']))
	{
		$reqid = $bdd->query('SELECT * FROM actu ORDER BY id_actualite DESC LIMIT 0,1');
		$idinfo = $reqid->fetch();
		$res = $idinfo['id_actualite']+1;
		echo $res;
		
		if(isset($_FILES['photo']) AND !empty($_FILES['photo']['name']))
		{
			$tailleMax = 2097152;	
			$extensionValides = array('jpg','jpeg','gif','png');
			if($_FILES['photo']['size']<= $tailleMax)
			{
				$extensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));
				if(in_array($extensionUpload, $extensionValides))
				{
					$chemin = "membres/actus/".$res.".".$extensionUpload;
					$resultat = move_uploaded_file($_FILES['photo']['tmp_name'],$chemin);
					if($resultat)
					{
						$updatephoto = $bdd->prepare('INSERT INTO actu(id_utilisateur,date_upload,URL) VALUES (?,CURRENT_TIMESTAMP,?)');
						$updatephoto->execute(array($_SESSION['id_utilisateur'],$res.".".$extensionUpload));
						header("Location:actualite.php?id_utilisateur=".$_SESSION['id_utilisateur']);
					}
					else
					{
						$message = "Erreur pendant l'importation de la photo !";
					}
				}
				else
				{
					$message = "Votre photo doit être au format jpg, jpeg, gif ou png !";
				}
			}
			else
			{
				$message = "Votre photo ne doit pas dépasser 2Mo !";
			}
		}
	}
}

	//ENREGISTREMENTS

	if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
	$getid = intval($_GET['id_utilisateur']);
	$requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id_utilisateur=?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
}

if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur']==$_SESSION['id_utilisateur'])
{
	if(isset($_POST['valider']))
	{
		$reqid = $bdd->query('SELECT * FROM actu ORDER BY id_actualite DESC LIMIT 0,1');
		$idinfo = $reqid->fetch();
		$res = $idinfo['id_actualite']+1;
		
		if(isset($_FILES['enregistrement']) AND !empty($_FILES['enregistrement']['name']))
		{
			$tailleMax = 5000000;	
			$extensionValides = array('mp3');
			if($_FILES['enregistrement']['size']<= $tailleMax)
			{
				$extensionUpload = strtolower(substr(strrchr($_FILES['enregistrement']['name'],'.'),1));
				if(in_array($extensionUpload, $extensionValides))
				{
					$chemin = "membres/actus/".$res.".".$extensionUpload;
					$resultat = move_uploaded_file($_FILES['enregistrement']['tmp_name'],$chemin);
					if($resultat)
					{
						$updateenregistrement = $bdd->prepare('INSERT INTO actu(id_utilisateur,date_upload,URL) VALUES (?,CURRENT_TIMESTAMP,?)');
						$updateenregistrement->execute(array($_SESSION['id_utilisateur'],$res.".".$extensionUpload));
						header("Location:actualite.php?id_utilisateur=".$_SESSION['id_utilisateur']);
					}
					else
					{
						$message = "Erreur pendant l'importation de l'enregistrement !";
					}
				}
				else
				{
					$message = "Votre enregistrement doit être au format mp3 !";
				}
			}
			else
			{
				$message = "Votre enregistrement ne doit pas dépasser 5Mo !";
			}
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
        
        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="css/styleactualite.css">
   
        
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

        
  

	    <meta charset="utf-8">	    

        <!-- Titre  -->
	    <title>Actualités - SoundMe</title>    
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
		      
		      <a href="profil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><img class="circle hoverable" src="membres/avatar/<?php if($userinfo['avatar'] == NULL) { echo "default.png"; } else {  echo $userinfo['avatar']; } ?>"></a>
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



<main>

<div class="container">
	
	<h1 class="left-align">Exprimez-vous, <?php echo $userinfo['prenom'] ;?></h1>

		<!--Affichage des erreurs-->
	     <div class="erreur">
     		 <?php if(isset($message)) {echo $message;}?>
    	</div>

	    <div class="row">
	      <div class=" col s3 center-align">
	      		<a class="btn-floating btn-large modal-trigger red darken-2 hoverable" href="#modal1"><i class="material-icons statut">edit
				</i></a><br>Statut
			</div>

	      <div class=" col s3 center-align">
	      		<a class="btn-floating btn-large  modal-trigger red darken-2 hoverable" href="#modal2"><i class="material-icons photo">photo_camera</i></a><br>Photo
	      	</div>

      		<div class=" col s3 center-align">
      			<a class="btn-floating btn-large  red darken-2 hoverable" href="videos.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons video">videocam</i></a><br>Vidéo
      		</div>

      		<div class=" col s3 center-align">
      			<a class="btn-floating btn-large red darken-2 hoverable modal-trigger hoverable" href="#modal4"><i class="material-icons enregistrement">mic</i></a><br>Enregistrement
      		</div>
    	</div>

  <!-- FENETRE DE STATUT -->
  <div id="modal1" class="modal">
  	<form method="POST" action="">
    <div class="modal-content">
      <h4>Publier un statut</h4>
      <br>			
		<div class="input-field">
          <i class="material-icons prefix">mode_edit</i>
          <textarea id="icon_prefix2" class="materialize-textarea" name="statut"></textarea><br></br>
          <label for="icon_prefix2">Exprime-toi !</label>
        </div>
		
    <div class="modal-footer">
    	<input type="submit" name="valider" value="Valider" class="modal-action modal-close waves-effect waves-green btn-flat"/>		 
    </div>
    </div>
   </form>
  </div>
	
  <!-- FENETRE DE PHOTO -->
  <div id="modal2" class="modal">
  	<form method="POST" action="" enctype="multipart/form-data">
    <div class="modal-content">
      <h4>Publier une photo</h4>
      <br>
      	

			<div class="file-field input-field">
				<div class="btn">
				   <input type="file" name="photo" />
				   <span>Fichier</span>
				 </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" placeholder="Charger une photo"><br></br>
				      </div>
				    </div>  
				  
    </div>
	    <div class="modal-footer">
	    	<input type="submit" name="valider" value="Valider" class="modal-action modal-close waves-effect waves-green btn-flat"/>
	    </div>
    </form>
  </div>

  <!-- FENETRE D'ENREGISTREMENT -->
  <div id="modal4" class="modal">
    
      <form method="POST" action="" enctype="multipart/form-data">
      	<div class="modal-content">
      	<h4>Publier un enregistrement</h4>
      	<br>
			<div class="file-field input-field">
				<div class="btn">
				   <span>Fichier</span>
				   <input type="file" name="enregistrement" />
				 </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" placeholder="Charger une photo"><br></br>
				      </div>
				    </div>  
				  
				  
	

    </div>
    <div class="modal-footer">
    	<input type="submit" name="valider" value="Valider" class="modal-action modal-close waves-effect waves-green btn-flat"/>
    </div>
    </form>
  </div>
				  

	      		
	
         	<?php
	
	while ($donnees = $reqactus->fetch())
	{
		$dejafollowed = $bdd->prepare('SELECT * FROM follow WHERE id_abonne = ? AND id_suivi=?');
		$dejafollowed->execute(array($_SESSION['id_utilisateur'],$donnees['id_utilisateur']));
		$dejafollowed = $dejafollowed->rowCount();
		
		
		if($dejafollowed == 1 OR $donnees['id_utilisateur']==$_SESSION['id_utilisateur'])
		{	

			$publisher = $bdd->prepare('SELECT * FROM utilisateur WHERE id_utilisateur = ?');
			$publisher->execute(array($donnees['id_utilisateur']));
			$publisher = $publisher->fetch();
			
	
		
			if($donnees['url']!=NULL)
			{
			$fichier = "membres/actus".$donnees['url'];
			$extension = pathinfo($fichier, PATHINFO_EXTENSION);

				//PHOTOS
			
				if($extension=='jpg' OR $extension=='jpeg' OR $extension=='gif' OR $extension=='png')
				{
				?>
					

				<ul class="collection z-depth-2">
			    	<li class="collection-item avatar">
			      	<img src="membres/avatar/<?php if($publisher['avatar'] == NULL) { echo "default.png"; } else {  echo $publisher['avatar']; } ?>" alt="" class="circle hoverable">
			      		<span class="title"><div class="nomstatut"><?php echo $publisher['prenom']." ".$publisher['nom']." :"; ?></div></span>
			         	<img src="membres/actus/<?php echo $donnees['url']; ?>" class="materialboxed" data-caption="Photo de <?php echo $userinfo['prenom']; ?>" width="250" />

      				<a href="#!" class="secondary-content"><i class="material-icons">thumb_up</i></a><br>

      				<a href="#!" class="secondary-content"><i class="material-icons">edit</i></a>



    			</li>
	  		</ul>
				<?php
				}

				//VIDEOS
				if($extension=='mp4')
				{
				?>
					<ul class="collection z-depth-2">
			    	<li class="collection-item avatar">
			      	<img src="membres/avatar/<?php if($publisher['avatar'] == NULL) { echo "default.png"; } else {  echo $publisher['avatar']; } ?>" alt="" class="circle hoverable">
			      		<span class="title"><div class="nomstatut"><?php echo $publisher['prenom']." ".$publisher['nom']." :"; ?></div></span>
			         	<video src="membres/actus/<?php echo $donnees['url']; ?>" controls poster="membres/actus/<?php echo $videos['URL']; ?>.jpg" width="250"></video>

      				<a href="#!" class="secondary-content"><i class="material-icons">thumb_up</i></a>

    			</li>
    		</ul>

				<?php
				}
				//MUSIQUE

					if($extension=='mp3')
					{
					?>
							<ul class="collection z-depth-2">
			    	<li class="collection-item avatar">
			      	<a href ="profil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>" ><img src="membres/avatar/<?php if($publisher['avatar'] == NULL) { echo "default.png"; } else {  echo $publisher['avatar']; } ?>" alt="" class="circle hoverable" ></a>
			      		<span class="title"><div class="nomstatut"><?php echo $publisher['prenom']." ".$publisher['nom']." :"; ?></div></span>
			         	<audio src="membres/actus/<?php echo $donnees['url']; ?>" controls></audio>

      				<a href="#!" class="secondary-content"><i class="material-icons">thumb_up</i></a>
    			</li>
    		</ul>
						
					<?php
					}	
			 }
			 //STATUT
			
			else
			{	?>
				  <ul class="collection z-depth-2">
				    <li class="collection-item avatar">
				      <img src="membres/avatar/<?php if($publisher['avatar'] == NULL) { echo "default.png"; } else {  echo $publisher['avatar']; } ?>" alt="" class="circle hoverable">
				      <span class="title"><div class="nomstatut"><?php echo $publisher['prenom']." ".$publisher['nom']." :"; ?></div></span>

				         <?php echo $donnees['description'];?>


				      <a href="edit.php" class="secondary-content"><i class="material-icons">thumb_up</i></a>
				       <input type="submit" name="supprimer" value="Supprimer" class="secondary-content"/>		 

				    </li>
				  </ul>
				
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
    $('.materialboxed').materialbox();
  });
	</script>
	
</body>

<footer>

		<h1>Footer</h1>
</footer>

</html>

<?php

}


?>