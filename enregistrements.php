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
        <!-- Titre  -->
	    <title>SoundMe</title>    
    </head>
<body>

	<h1>Publier un enregistrement !</h1>

	<form method="POST" action="" enctype="multipart/form-data">
					
		<input type="file" name="enregistrement" /><br><br>
		<input type="submit" name="valider" value="Valider"/>
				  
	</form>
</body>
</html>

<?php
}
?>