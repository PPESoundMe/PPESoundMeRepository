<?php //include "../inc/dbinfo.inc"; ?>

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

$pdo = new PDO('mysql:host=localhost;dbname=soundme', 'root', '');

if(isset($_POST['formconnexion']))
{
	$mailconnect=htmlspecialchars($_POST['mailconnect']);
	$mdpconnect=sha1($_POST['mdpconnect']);
	if(!empty($mailconnect) AND !empty($mdpconnect))
	{
		$requser= $pdo->prepare("SELECT * FROM Utilisateur WHERE email=? AND mdp=?");
		$requser->execute(array($mailconnect, $mdpconnect));
		$userexist= $requser->rowCount();
		
		if($userexist == 1)
		{
			$userinfo = $requser->fetch();
			
			$_SESSION['id_utilisateur']=$userinfo['id_utilisateur'];
			$_SESSION['email']=$userinfo['email'];
            
			header("Location:profil.php?id_utilisateur=".$_SESSION['id_utilisateur']);
		}
		else
		{
			$erreur = " Vous avez entré les mauvais identifiants !";
		}
	}
	else
	{
		$erreur= "Tous les champs doivent être complétés !";
	}
}
?>

<!-- Début HTML  -->
<html>
	<head>
	    <meta charset="utf-8">
	   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<meta name="description" content="SoundMe Réseau Social">
	    <meta name="keywords" content="SoundMe, music, rencontre, réseau, social, instrument, studio, réservation, apprendre">
	    <meta name="author" content="PPE SoundMe">
        
        <!-- Feuilles de style  -->
	    <link rel="stylesheet" href="css/styleconnexion.css">
        <link href="css/hover-min.css" rel="stylesheet">
	    
        <!-- Titre  -->
	    <title>SoundMe</title>    
  </head>
	<body>
        
        
        <!-- Headerlogo  -->
        <header> 
            <figure>
                <img src="photos/noteblanche.png" alt="logoSoundMe">
            </figure>
        </header>
        
        <!-- Box de connexion  -->
		<main>
			
			<h1>Connexion</h1>

			<?php
			if(isset($erreur))
			{
				echo $erreur;
			}
			?> 
			
            <!-- Formulaire  -->
			<form method="POST" action="">
                
                 <!-- Mail  -->
			    <input class="champ" type="text" name="mailconnect" placeholder="Adresse e-mail" />
                
                 <!-- MDP  -->
				<input class="champ" type="password" name="mdpconnect" placeholder="Mot de passe" />
                
                 <!-- Bouton  -->
				<a href="#" class="button hvr-underline-from-center"> 
                   <input class="valide" type="submit" name="formconnexion" value="Se connecter"/>
                </a>
                
                 <!-- Pas encore inscrit?  -->
				<a href="inscription.php" class="button hvr-grow">Pas encore inscrit ? Crée ton compte maintenant !</a>
              
          
		    </form>
			
        </main>	
			
	</body>
</html>