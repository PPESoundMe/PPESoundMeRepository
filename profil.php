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

$pdo = new PDO('mysql:host=localhost;dbname=soundme', 'root', 'root');

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
	  
        <link rel="stylesheet" href="css/default.css">
   
        
    	<script type="text/javascript" src="js/materialize.min.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    	<!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
       <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

         <!-- Bibliothèques JQuery  -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

         <!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

    	<!-- Compiled and minified JavaScript -->
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
	</head>

	<header>
			<!-- NAVBAR DU HAUT  -->
			  <nav>
    			<nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo"><i class="material-icons">cloud</i>Logo</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="sass.html"><i class="material-icons">search</i></a></li>
        <li><a href="badges.html"><i class="material-icons">view_module</i></a></li>
        <li><a href="collapsible.html"><i class="material-icons">refresh</i></a></li>
        <li><a href="mobile.html"><i class="material-icons">more_vert</i></a></li>
      </ul>
    </div>
  </nav>
  			</nav>

	</header>
	<body>
	
	
		
	

	<!-- NAVBAR DU BAS  -->		
		<ul id="slide-out" class="sidenav sidenav-fixed">
		    <li><div class="user-view">
		      <div class="background">
		        <img src="photos/fond.jpg">
		      </div>
		      <a href="#"><img class="circle hoverable" src="photos/fond.jpg"></a>
		      <a href="#name"><span class="white-text name"><?php echo $userinfo['prenom'] ; echo(" "); echo $userinfo['nom'] ; ?></span></a>
		      <a href="#email"><span class="white-text email"><?php echo $userinfo['email'] ;?></span></a>
		    </div></li>

		    <ul class="collapsible collapsible-accordion">
		          <li>
		            <a class="collapsible-header">Mon espace<i class="material-icons">arrow_drop_down</i></a>
		            <div class="collapsible-body">
		              <ul>
		                <li><a href="#!"><i class="material-icons">music_note</i>Mes groupes</a></li>
		                <li><a href="#!"><i class="material-icons">group_add</i>Mes abonnés</a></li>
		                <li><a href="#!"><i class="material-icons">today</i>Mes événements</a></li>

		              </ul>
		            </div>
		          </li>
		        </ul>
		    <li><a href="#!"><i class="material-icons">language</i>Actualités</a></li>
		    <li><a href="#!"><i class="material-icons">location_on</i>Soundmap</a></li>
		 
		    <li><a href="#!"><i class="material-icons">headset</i>Mes réservations</a></li>
		    <li><a href="#!"><i class="material-icons">settings</i>Paramètres</a></li>
		    <li><a href="#!"><i class="material-icons">settings_power</i>Déconnexion</a></li>
		    
		    <ul class="collapsible collapsible-accordion">
		          <li>
		            <a class="collapsible-header">Messagerie<i class="material-icons">message</i></a>
		            <div class="collapsible-body">
		              <ul>
		                <li><a href="#!">Envoyer un message</a></li>
		                <li><a href="#!">Mes messages</a></li>

		              </ul>
		            </div>
		          </li>
		        </ul>
		    <li><div class="divider"></div></li>
		    <li><a class="subheader">Subheader</a></li>
		    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
		  </ul>
		  <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

    


	<!-- CONTENU DE LA PAGE  -->		
	<main>
		<h1>hello</h1>
		<h1> Profil de <?php echo $userinfo['prenom']; ?></h1>
	


			
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
</main>
			
	<!-- Dossier Javascript -->
	<script type="text/javascript">
		 $(document).ready(function(){
    	$('.sidenav').sidenav();
    	 $('.sidenav').sidenav('methodName');
    $('.sidenav').sidenav('methodName', paramName);

  		});
	</script>
	</body>

<footer></footer>


</html>

