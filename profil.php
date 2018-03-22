<?php // include "../inc/dbinfo.inc"; ?>

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

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
	$getid = intval($_GET['id_utilisateur']);
	$requser = $pdo->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur=?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
}

?>

<html>
	<head>
		<title>Profil</title>
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
			
			<h1> Profil de <?php echo $userinfo['prenom']; ?></h1>
			<br /><br />
			
			
			<?php
				if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur']==$_SESSION['id_utilisateur'])
				{
				
				}
			?>
			<?php
				if(isset($_SESSION['id_utilisateur']) AND $_SESSION['id_utilisateur']!=$getid)
				{
					$isfollowingornot = $pdo->prepare('SELECT * FROM Abonnement WHERE id_abonne=? AND id_suivi=?');
					$isfollowingornot->execute(array($_SESSION['id_utilisateur'],$getid));
					$isfollowingornot = $isfollowingornot->rowCount();
					if($isfollowingornot==1)
					{
					?>
					<a href="follow.php?followedid=<?php echo $getid; ?>">Ne plus suivre cette personne</a>
					<?php
					}
					else
					{
					
				?>
				<a href="follow.php?followedid=<?php echo $getid; ?>">Suivre cette personne</a>
		
				<?php
				}
				}
			?>
			
	
			
	</body>
</html>

