<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=soundme', 'root', 'root');

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
			$req= $bdd->prepare("INSERT INTO actu(id_utilisateur,description,date_upload) VALUES(?,?,CURRENT_TIMESTAMP)");
			$req->execute(array($_SESSION['id_utilisateur'],$statut));
			header("Location:actualite.php?id_utilisateur=".$_SESSION['id_utilisateur']);
			
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
	    <title>Statuts - SoundMe</title>    
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