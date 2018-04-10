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

if(isset($_SESSION['id_utilisateur']) AND !empty($_SESSION['id_utilisateur']))
{
$msg = $pdo->prepare('SELECT * FROM Messsage WHERE id_destinataire=?');
$msg->execute(array($_SESSION['id_utilisateur']));
$msg_nbr = $msg->rowCount();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Boite de réception</title>
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
	    <title>Inscription</title> 
</head>

<body>

	<!-- Headerlogo  -->
        <header> 
            <figure>
                <img src="style/photos/noteblanche.png" alt="logoSoundMe">
            </figure>
        </header>
        
        
        <!-- Début du menu sur le côté  -->
        <aside>
            
            <!-- Barre de recherche  -->
            <nav class="main-nav">
                <form action="">
                    <input id="barnav" type = "text" name="" placeholder="RECHERCHE...">
                </form>
                <ul class="main-nav-ul">
                    
                    <li class="has-sub"><a href="profil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Profil<span class="sub-arrow"></span></a>
                        <ul>
                            <li><a href="#">Mes groupes</a></li>
                            <li><a href="#">Mes abonnés</a></li>
                            <li><a href="#">Mes événements</a></li>
                        </ul>

                    </li>
                    <li><a href="actualite.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Actualités</a></li>
                    <li><a href="carte.php">SoundMap</a></li>
                    <li class="has-sub"><a href="#">Messagerie<span class="sub-arrow"></span></a>
                        <ul>
                            <li><a href="envoi.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Envoyer un message</a></li>
                            <li><a href="reception.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Mes messages</a></li>
                        </ul>

                    </li>
                    <li><a href="#">Mes réservations</a></li>
                    <li><a href="parametres.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Paramètres</a></li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                
                </ul>
            
            </nav>
        </aside>
	
	<a href="envoi.php">Nouveau message</a>
	<h3> Vos messages </h3>
	<?php 
	if($msg_nbr == 0) { echo "Vous n'avez aucun message !"; }
	while($m = $msg->fetch()) { 
		
		$p_exp = $pdo->prepare('SELECT prenom FROM Utilisateur WHERE id_utilisateur=?');
		$p_exp->execute(array($m['id_expediteur']));
		$p_exp = $p_exp->fetch();
		$p_exp = $p_exp['prenom'];
	?>
	
	<b><?= $p_exp ?></b> vous a envoyé : <br/>
	<?= nl2br($m['message']); ?> <br><br><br>
	
		
	<?php } ?>
	
	<a href="profil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Retour</a>
	
</body>

</html>

<?php } ?>