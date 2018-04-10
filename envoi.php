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
	
	if(isset($_POST['envoi_message']))
	{
		if(!empty($_POST['destinataire']) AND !empty($_POST['message']))
		{
			$destinataire = strtolower(htmlspecialchars($_POST['destinataire'])); 
			$message = htmlspecialchars($_POST['message']);
			
			$id_destinataire = $pdo->prepare('SELECT id_utilisateur FROM Utilisateur WHERE prenom=?');
			$id_destinataire->execute(array($destinataire));
			$dest_exist = $id_destinataire->rowCount();
			
			if($dest_exist == 1)
			{
				$id_destinataire = $id_destinataire->fetch();
				$id_destinataire = $id_destinataire['id_utilisateur'];
				
				$ins = $pdo->prepare('INSERT INTO Messsage(id_expediteur,id_destinataire,message) VALUES (?,?,?)');
				$ins->execute(array($_SESSION['id_utilisateur'],$id_destinataire,$message));
				
				$error = "Votre message a bien été envoyé !";
			}
			else
			{
				$error = "Cet utilisateur n'existe pas !";
			}
			
		}
		else
		{
			$error = "Veuillez compléter tous les champs !";
		}
	}

	$destinataires = $pdo->query('SELECT prenom FROM Utilisateur ORDER BY prenom');

?>

	<!DOCTYPE html>

	<html>

	<head>
		<meta charset="utf-8">
	   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<meta name="description" content="SoundMe Réseau Social">
	    <meta name="keywords" content="SoundMe, music, rencontre, réseau, social, instrument, studio, réservation, apprendre, parametres">
	    <meta name="author" content="PPE SoundMe">
        
        <!-- Feuilles de style  -->
	    <link rel="stylesheet" href="style/css/styleparametre.css">
        <link rel="stylesheet" href="style/css/stylenavbar.css">
        <link href="style/css/hover-min.css" rel="stylesheet">
        
        <!-- Ajout du js pour la navbar  -->
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(e){
                $('.has-sub').click(function(){
                    $(this).toggleClass('tap');
                })
            })
        </script>
		<title>Envoi de messages</title>
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

		<form method="POST">
			<label>Destinataire :</label>
			<select name="destinataire">			
				<?php

				while ($d = $destinataires->fetch()){  ?>
					<option><?php echo $d['prenom'];?></option>
				<?php }
				?>			
			</select>
			<br/><br/>
			<textarea placeholder="Votre message" name="message"></textarea>
			<br/><br/>
			<input type="submit" value="Envoyer" name="envoi_message" />
			<br/><br/>
			<?php if (isset($error)) {echo $error;} ?>
		</form>
		<br/>
		<a href="reception.php">Mes messages</a> <br/><br/>
		
		<a href="profil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Retour</a>
		

	</body>

	</html>
<?php } ?>
