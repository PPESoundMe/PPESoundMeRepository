<?php //include "../inc/dbinfo.inc"; ?>

<?php

session_start();
<<<<<<< HEAD

=======
>>>>>>> 0b3aa450578f89b20d341c4aebc1b26d65d9d2e1
/*$dbhost = DB_SERVER;
$dbport = DB_PORT;
$dbname = DB_DATABASE;
$charset = 'utf8' ;
$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$username = DB_USERNAME;
$password = DB_PASSWORD;

$pdo = new PDO($dsn, $username, $password);*/

$pdo = new PDO('mysql:host=localhost;dbname=soundme','root','');

if(isset($_POST['forminscription']))
{
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$age = htmlspecialchars($_POST['age']);
	$sexe = isset($_POST['sexe']) ? $_POST['sexe'] : NULL;
	$email = htmlspecialchars($_POST['email']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);
		
	if((!empty($_POST['nom'])) AND (!empty($_POST['prenom'])) AND (!empty($_POST['age'])) AND (!empty($_POST['email'])) AND (!empty($_POST['mdp'])) AND (!empty($_POST['mdp2'])))
	{		
		$nomlength = strlen($nom);
		$prenomlength = strlen($prenom);
		
		if($nomlength <= 20)
		{
			if($prenomlength <= 20)
			{
				if(filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					$reqmail = $pdo->prepare("SELECT * FROM utilisateur WHERE email=?");
					$reqmail->execute(array($email));
					$mailexist=$reqmail->rowCount();
					
					if($mailexist==0)
					{					
						if($mdp == $mdp2)
						{
							$insertmbr = $pdo->prepare("INSERT INTO utilisateur(nom, prenom, sexe, age,email,mdp) VALUES(?, ?, ?, ?, ?, ?)");
							$insertmbr->execute(array($nom, $prenom, $sexe, $age, $email, $mdp));
							$requser= $pdo->prepare("SELECT * FROM utilisateur WHERE email=? AND mdp=?");		
							$requser->execute(array($email,$mdp));		     
							$userinfo = $requser->fetch();
			
							$_SESSION['id_utilisateur']=$userinfo['id_utilisateur'];
							$_SESSION['email']=$userinfo['email'];

							
            
							header("Location:inscription_facultative.php?id_utilisateur=".$_SESSION['id_utilisateur']);
						}
						else
						{
							$erreur = "Vos mots de passe doivent être identiques";
						}
					}
					else
					{
						$erreur="Adresse e-mail déjà utilisée";
					}
				}
				else
				{
					$erreur = "Votre adresse e-mail n'est pas valide";
				}
			}
			else
			{
				$erreur = "Votre prénom ne doit pas dépasser 20 caractères";
			}
		}
					
		else
		{
			$erreur = "Votre nom ne doit pas dépasser 20 caractères";
		}
		
		$prenomlength = strlen($prenom); //pourquoi deux fois ?
		
		
	}
	else
	{
		$erreur = "Tous les champs doivent être complétés";
	}
}

?>

<!-- Début HTML  -->
<html>
	<head>
		<head>
	    <meta charset="utf-8">
	   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<meta name="description" content="SoundMe Réseau Social">
	    <meta name="keywords" content="SoundMe, music, rencontre, réseau, social, instrument, studio, réservation, apprendre">
	    <meta name="author" content="PPE SoundMe">
		<link rel="shortcut icon" href="photos/logo_onglet.ico">      
        <!-- Feuille de style  -->
	    <link rel="stylesheet" href="css/stylelogin.css">
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
        
          <header> 
	            <figure>

	              
	                <a href="accueil.php" class="  "><img src="photos/noteblanche.png" alt="logoSoundMe"></a> 

	            </figure>
	        </header>
	        
            <!-- Box d'inscriptino  -->
        <div class="container">
	        <!-- Header logo  -->

        	<div class="box">

			<h1>Inscription</h1>
	
		  		<div class="row">

		  			<!-- Début du formulaire  -->
    				<form method="POST" action="" class="col s12">

     	 				<div class="row">
					    	<!-- Prénom  -->
					        <div class="input-field col s6">
					          <input id="prenom" type="text" class="validate" name="prenom" value="<?php if(isset($prenom)) {echo $prenom;} ?>">
					          <label for="prenom">Prénom</label>
					        </div>

				        <!-- Nom  -->
				        <div class="input-field col s6">
				          <input id="nom" type="text" class="validate" name="nom" value="<?php if(isset($nom)) {echo $nom;} ?>">
				          <label for="nom">Nom</label>
				        </div>
				      </div>


				      <!-- Date  -->
				 		<div class="row">
				        	<div class="input-field col s12">
				        		<input type="date" id="age" class="validate" name="age" min='1910-01-01' max='2002-12-31' value="<?php if(isset($age)) {echo $age;} ?>" />
				        	</div>
				      </div>
   
				   		<!-- Sexe  -->
				 		<div class="row">
				        	<div class="input-field col s12">
				        		<p id="sexe">
							      <label for ="homme">
							        <input id="homme" name="sexe" type="radio" value"homme" checked />
							        <span>Homme</span>
							      </label></p></br>
							      <p id="sexe">
							      <label for ="femme">
							        <input id="femme" name="sexe" type="radio" value"femme" />
							        <span>Femme</span>
							      </label></p>


						    </p>				        		
			        	</div>
				      </div>


				      <!-- mail  -->
				      <div class="row">
				        <div class="input-field col s12">
				          <input type="email" class="validate" id="email" name="email" value="<?php if(isset($email)) {echo $email;} ?>" />
				          <label for="email">Email</label>        
				        </div>
				        </div>
     


				        <div class="row">
					    	<!-- Mdp  -->
					        <div class="input-field col s6">
					          <input type="password" id="mdp" name="mdp"class="validate" />
				          <label for="mdp">Mot de passe</label>
					        </div>

				        <!-- Mdpconfirmation  -->
				        <div class="input-field col s6">
				          <input type="password" id="mdp2" name="mdp2" class="validate" />
				          <label for="mdp">Confirmation mot de passe</label>
				        </div>
				      </div>

				      

			      <!-- valider  -->
				<div class="row">
			        <div class="input-field col s6">   
				        <button id="valide" class="btn waves-effect waves-light red accent-3" type="submit" name="forminscription" value="Je m'inscris">Je m'inscris
	    					<i class="material-icons right">send</i>
	 					 </button>
			        </div>
			    
			      </div>
				
      
 
   
    		</form>
     <!-- fin du formulaire
       -->

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

