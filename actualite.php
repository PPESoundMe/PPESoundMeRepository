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
	$reqactus = $bdd->query('SELECT * FROM actu ORDER BY date_upload DESC ');
	
	?>


<html>
	<head>
	    <meta charset="utf-8">	    
        <!-- Titre  -->
	    <title>SoundMe</title>    
    </head>
<body>

	<h1>Actualités</h1>
	
	<a href="statuts.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Publier un statut !</a><br/>
	<a href="photos.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Publier une photo !</a><br/>
	<a href="videos.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Publier une vidéo !</a><br/>
	<a href="enregistrements.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Publier un enregistrement !</a><br/><br><br><br>
	
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
			
			?><strong> <?php echo $publisher['prenom']." ".$publisher['nom']." : <br><br>"; ?></strong> 
			
			<?php
		
			if($donnees['url']!=NULL)
			{
			$fichier = "membres/actus".$donnees['url'];
			$extension = pathinfo($fichier, PATHINFO_EXTENSION);
			
				if($extension=='jpg' OR $extension=='jpeg' OR $extension=='gif' OR $extension=='png')
				{
				?>
					<img src="membres/actus/<?php echo $donnees['url']; ?>" width="150" /><br><br>
				<?php
				}
				
				if($extension=='mp4')
				{
				?>
					<video src="membres/actus/<?php echo $donnees['url']; ?>" controls poster="membres/actus/<?php echo $videos['URL']; ?>.jpg" width="150"></video><br><br>
				<?php
				}
				
				if($extension=='mp3')
				{
				?>
					<audio src="membres/actus/<?php echo $donnees['url']; ?>" controls></audio><br><br>
				<?php
				}
					
			
			}
			
			else
			{
				echo $donnees['description'];
			}
		}
	}
	
	?>
	
	
	
</body>
</html>

<?php

}


?>