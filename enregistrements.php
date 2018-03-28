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
		if(isset($_FILES['enregistrement']) AND !empty($_FILES['enregistrement']['name']))
		{
			echo "ok";
			$tailleMax = 5000000;	
			$extensionValides = array('mp3');
			if($_FILES['enregistrement']['size']<= $tailleMax)
			{
				$extensionUpload = strtolower(substr(strrchr($_FILES['enregistrement']['name'],'.'),1));
				if(in_array($extensionUpload, $extensionValides))
				{
					$chemin = "membres/enregistrements/".$_SESSION['id_utilisateur'].".".$extensionUpload;
					$resultat = move_uploaded_file($_FILES['enregistrement']['tmp_name'],$chemin);
					if($resultat)
					{
						$updateenregistrement = $bdd->prepare('INSERT INTO enregistrement(URL,id_utilisateur) VALUES (?,?)');
						$updateenregistrement->execute(array($_SESSION['id_utilisateur'].".".$extensionUpload,$_SESSION['id_utilisateur']));
						header("Location:actualite.php?id_utilisateur=".$_SESSION['id_utilisateur']);
					}
					else
					{
						echo "Erreur pendant l'importation de l'enregistrement !";
					}
				}
				else
				{
					echo "Votre photo doit être au format mp3 !";
				}
			}
			else
			{
				echo "Votre enregistrement ne doit pas dépasser 5Mo !";
			}
		}
	}
?>


<html>
	<head>
	    <meta charset="utf-8">	
	    <link rel="shortcut icon" href="photos/logo_onglet.ico">    
        <!-- Titre  -->
	    <title>SoundMe</title>    
    </head>
<body>

	<h1>Publier une vidéo !</h1>

	<form method="POST" action="" enctype="multipart/form-data">
					
		<input type="file" name="enregistrement" /><br><br>
		<input type="submit" name="valider" value="Valider"/>
				  
	</form>
</body>
</html>

<?php
}
?>