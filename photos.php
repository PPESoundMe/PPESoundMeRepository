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
						echo "Erreur pendant l'importation de la photo !";
					}
				}
				else
				{
					echo "Votre photo doit être au format jpg, jpeg, gif ou png !";
				}
			}
			else
			{
				echo "Votre photo ne doit pas dépasser 2Mo !";
			}
		}
	}
?>


<html>
	<head>
	    <meta charset="utf-8">
	    <link rel="shortcut icon" href="photos/logo_onglet.ico">	    
        <!-- Titre  -->
	    <title>Photos - SoundMe</title>    
    </head>
<body>

	<h1>Publier une photo !</h1>

	<form method="POST" action="" enctype="multipart/form-data">
	
		<input type="file" name="photo" /><br><br>
		<input type="submit" name="valider" value="Valider"/>
				  
	</form>
</body>
</html>

<?php
}
?>