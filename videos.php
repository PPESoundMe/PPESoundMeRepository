<?php
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
	if(isset($_POST['valider']))
	{
		if(isset($_FILES['video']) AND !empty($_FILES['video']['name']))
		{
			echo "ok";
			$tailleMax = 100000000;	
			$extensionValides = array('mp4');
			if($_FILES['photo']['size']<= $tailleMax)
			{
				$extensionUpload = strtolower(substr(strrchr($_FILES['video']['name'],'.'),1));
				if(in_array($extensionUpload, $extensionValides))
				{
					$chemin = "membres/videos/".$_SESSION['id_utilisateur'].".".$extensionUpload;
					$resultat = move_uploaded_file($_FILES['video']['tmp_name'],$chemin);
					if($resultat)
					{
						$updatevideo = $bdd->prepare('INSERT INTO video(URL,id_utilisateur) VALUES (?,?)');
						$updatevideo->execute(array($_SESSION['id_utilisateur'].".".$extensionUpload,$_SESSION['id_utilisateur']));
						header("Location:actualite.php?id_utilisateur=".$_SESSION['id_utilisateur']);
					}
					else
					{
						echo "Erreur pendant l'importation de la video !";
					}
				}
				else
				{
					echo "Votre photo doit être au format ogg ou mp4 !";
				}
			}
			else
			{
				echo "Votre vidéo ne doit pas dépasser 100Mo !";
			}
		}
	}
?>


<html>
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
	    <title>Vidéos - SoundMe</title>   
    </head>
<body>

	<h1>Publier une vidéo !</h1>

	<form method="POST" action="" enctype="multipart/form-data">
					
		<input type="file" name="video" /><br><br>
		<input type="submit" name="valider" value="Valider"/>
				  
	</form>
</body>
</html>

<?php
}
?>