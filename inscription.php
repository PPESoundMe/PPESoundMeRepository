<?php //include "../inc/dbinfo.inc"; ?>

<?php

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
					$reqmail = $pdo->prepare("SELECT * FROM Utilisateur WHERE email=?");
					$reqmail->execute(array($email));
					$mailexist=$reqmail->rowCount();
					
					if($mailexist==0)
					{					
						if($mdp == $mdp2)
						{
							$insertmbr = $pdo->prepare("INSERT INTO Utilisateur(nom, prenom, sexe, age,email,mdp) VALUES(?, ?, ?, ?, ?, ?)");
							$insertmbr->execute(array($nom, $prenom, $sexe, $age, $email, $mdp));
							$requser= $pdo->prepare("SELECT * FROM Utilisateur WHERE email=? AND mdp=?");		
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
            
        <!-- Feuille de style  -->
	    <link rel="stylesheet" href="css/styleinscription.css">
        
        <!-- Titre  -->
	    <title>Inscription</title> 
	</head>
	
	<body>
        
        
        <!-- Header logo  -->
        <header> 
            <figure>
                <img src="photos/noteblanche.png" alt="logoSoundMe">
            </figure>
        </header>
        
        
        <!-- Box d'inscriptino  -->
        <main>
		<h1>Inscription</h1>
	
		
        <!-- Formulaire  -->
		<form method="POST" action="   ">
			             
                    <!-- Nom  -->
                    <p>
						<input type="text" placeholder="Votre nom" id="nom" name="nom" value="<?php if(isset($nom)) {echo $nom;} ?>"  />
                    </p>
					
				     <!-- Prénom  -->
                    <p>
						<input type="text" placeholder="Votre prénom" id="prenom" name="prenom" value="<?php if(isset($prenom)) {echo $prenom;} ?>" />
                    </p>
					
					 <!-- Date  -->
                    <p>
						<input type="date" placeholder="Votre date de naissance" id="age" name="age" min='1910-01-01' max='2002-12-31' value="<?php if(isset($age)) {echo $age;} ?>" />
                    </p>
				
					 <!-- Homme/Femme  -->
                    <p id="sexe">
						<label for="homme">Homme</label><input type="radio" id="homme" name="sexe" value="homme"/>
						<label for="femme">Femme</label><input type="radio" id="femme" name="sexe" value="femme"/>
                    </p>
				
						 <!-- Mail  -->
                    <p>
						<input type="mail" placeholder="Votre e-mail" id="email" name="email" value="<?php if(isset($email)) {echo $email;} ?>" />
                    </p>
				
					
					 <!-- MDP  -->
                    <p>
						<input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                    </p>
				
					 <!-- Confirmation MDP  -->
                    <p>
						<input type="password" placeholder="Confirmer mot de passe" id="mdp2" name="mdp2" />
                    </p>
	   
                <p>
			<input id="valide" type="submit" name="forminscription" value="Je m'inscris" />
            </p>
		</form>
		<?php 
		if(isset($erreur))
		{
			echo $erreur;
		}
		?>
        </main>
	</body>
</html>