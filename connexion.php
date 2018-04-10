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
        
        $reqstudio= $pdo->prepare("SELECT * FROM Studio WHERE email_studio=? AND mdp_studio=?");
		$reqstudio->execute(array($mailconnect, $mdpconnect));
		$studioexist= $reqstudio->rowCount();
		
		if($userexist == 1)
		{
			$userinfo = $requser->fetch();
			
			$_SESSION['id_utilisateur']=$userinfo['id_utilisateur'];
			$_SESSION['email']=$userinfo['email'];
            
			header("Location:profil.php?id_utilisateur=".$_SESSION['id_utilisateur']);
		}
		else if ($studioexist==1)
		{
			$stdinfo = $reqstudio->fetch();
			
			$_SESSION['id_studio']=$stdinfo['id_studio'];
			$_SESSION['email_studio']=$stdinfo['email_studio'];
            
			header("Location:profilstudio.php?id_studio=".$_SESSION['id_studio']);

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
	    <link rel="stylesheet" href="css/stylelogin.css">
	    <link rel="stylesheet" href="css/default.css">
        <link href="css/hover-min.css" rel="stylesheet">


        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

         <!-- Bibliothèques JQuery  -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
	    
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
	<div class="container">
		<div class="boxconnexion">
			
			<h1>Connexion</h1>

			<div class="row">


            <!-- Formulaire  -->
			<form method="POST" action="" class="col s12">
                

                 <!-- Mail  -->

				      <div class="row">
				        <div class="input-field col s12">
				          <input type="email" class="validate" id="email" name="mailconnect" />
				          <label for="email">Email</label>        
				        </div>
				        </div>



				        <div class="row">
					    	<!-- Mdp  -->
					        <div class="input-field col s12">
					          <input type="password" id="mdp" name="mdpconnect" class="champ" />
				          <label for="mdp">Mot de passe</label>
					       </div>
					     </div>

			  

                     <!-- valider  -->
				<div class="row">
			        <div class="input-field col s12">   
				        <button id="valide" class="btn waves-effect waves-light blue" type="submit" name="formconnexion" value="Je me connecte">Je me connecte
	    					<i class="material-icons right">send</i>
	 					 </button>
			         
			        </div>
			      </div>
               
                
                 <!-- Pas encore inscrit?  -->
				<a href="inscription.php" class="">Pas encore inscrit ? Crée ton compte maintenant !</a>
              
          
		    </form>

		    		<div class="erreur">
						<?php
						if(isset($erreur))
						{
							echo $erreur;
						}
						?> 
					</div>
			</div>
		</div>
		</div>
			
	</body>
</html>