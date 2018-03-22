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
		$statut=$_POST['statut'];
		
		
		if(!empty($statut))
		{
			$req= $bdd->prepare("INSERT INTO statut(description,date,id_utilisateur) VALUES(?,CURRENT_TIMESTAMP,?)");
			$req->execute(array($statut,$_SESSION['id_utilisateur']));
			header("Location:actualite.php?id_utilisateur=".$_SESSION['id_utilisateur']);
			
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

	<h1>Publier un statut !</h1>

	<form method="POST" action="">
					
		<textarea name="statut" id="statut" placeholder="Exprimez-vous !"></textarea><br><br>
		<input type="submit" name="valider" value="Valider"/>
				  
	</form>
</body>
</html>

<?php
}
?>