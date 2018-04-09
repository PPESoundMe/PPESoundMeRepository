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

$pdo = new PDO('mysql:host=localhost;dbname=soundme','root','');

if(isset($_POST['forminscriptionstudio']))
{
	$nomstudio = htmlspecialchars($_POST['nomstudio']);
	$adresstudio = htmlspecialchars($_POST['adresstudio']);
	$telstudio = htmlspecialchars($_POST['telstudio']);
	$nbrsalles = htmlspecialchars($_POST['nbrsalles']);
	$email = htmlspecialchars($_POST['email']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);

		
	if((!empty($_POST['nomstudio'])) AND (!empty($_POST['adresstudio'])) AND (!empty($_POST['telstudio'])) AND (!empty($_POST['nbrsalles'])) AND (!empty($_POST['email'])) AND (!empty($_POST['mdp'])) AND (!empty($_POST['mdp2'])))
	{		
		$nomlength = strlen($nomstudio);
		
		
		$taille_max= 2000000;
		$extensionvalide= $arrayName = array('jpeg', 'jpg', 'png');

		
		if($nomlength <= 30)
		{
	
			    if(filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					$reqmail = $pdo->prepare("SELECT * FROM Studio WHERE email_studio=?");
					$reqmail->execute(array($email));
					$mailexist=$reqmail->rowCount();
					
					if($mailexist==0)
					{					
						if($mdp == $mdp2)
						{

							/*if($FILES['photostudio']['size'] <= $taille_max)
							{ 

							  $extension= strtolower(substr(strrchr($FILES['photostudio']['name'], '.'), start));

							    if(in_array($extension, $extensionvalide))
							    { 	*/

							     

							     $insertstd = $pdo->prepare("INSERT INTO studio(nom_studio, adresse_studio, telephone_studio, email_studio, nombre_salle, mdp_studio) VALUES(?, ?, ?, ?, ?, ?)");

							     $insertstd->execute(array($nomstudio, $adresstudio, $telstudio, $email, $nbrsalles, $mdp));

							     /*$chemin="photos/couvstudios/".$_SESSION['id_studio'].".".$extension;
							     $placement= move_uploaded_file($FILES['photostudio']['tmp_name'], $chemin); */

							     $reqstudio= $pdo->prepare("SELECT * FROM studio WHERE email_studio=? AND mdp_studio=?");		
							     $reqstudio->execute(array($email,$mdp));		     
							     $userinfo = $reqstudio->fetch();

			
							     $_SESSION['id_studio']=$userinfo['id_studio'];
							     $_SESSION['email_studio']=$userinfo['email_studio'];

							     header("Location:profilstudio.php?id_studio=".$_SESSION['id_studio']);
						         }

						     
						    /* else
						     {
						     	$erreur="La taille de votre photo doit être inférieure à 2Mo.";
						     }      */           
							
						
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
			$erreur = "Le nom du studio ne doit pas dépasser 30 caractères";
		}
			
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
		
	    <meta charset="utf-8">
	   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<meta name="description" content="SoundMe Réseau Social">
	    <meta name="keywords" content="SoundMe, music, rencontre, réseau, social, instrument, studio, réservation, apprendre">
	    <meta name="author" content="PPE SoundMe">
            
        <!-- Feuille de style  -->
	    <link rel="stylesheet" href="css/styleinscription.css">
        
        <!-- Titre  -->
	    <title>Inscription Studio</title> 
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
		<h1>Inscription Studio</h1>
	
		
        <!-- Formulaire  -->
		<form method="POST" action="   " >
			             
                    <!-- Nom  -->
                    <p>
						<input type="text" placeholder="Nom du studio" id="nomstudio" name="nomstudio"  />
                    </p>
					
				     <!-- Adresse  -->
                    <p>
						<input type="text" placeholder="Adresse du studio" id="adresstudio" name="adresstudio"  />
                    </p>
					
					 <!-- Téléphone  -->
                    <p>
						<input type="text" placeholder="Numéro de téléphone" id="telstudio" name="telstudio"  />
                    </p>

                     <!-- Nombre de Salles  -->
                    <p>
						<input type="text" placeholder="Nombre de salles" id="nbrsalles" name="nbrsalles"  />
                    </p>
									
				
						 <!-- Mail  -->
                    <p>
						<input type="mail" placeholder="e-mail" id="email" name="email" />
                    </p>
				
					
					 <!-- MDP  -->
                    <p>
						<input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                    </p>
				
					 <!-- Confirmation MDP  -->
                    <p>
						<input type="password" placeholder="Confirmer mot de passe" id="mdp2" name="mdp2" />
                    </p>

                     <!-- Photo de couverture 
                     <p>
                     	<label>Photo :</label>
                     	<input type="file"  id="photostudio" name="photostudio" />
                     </p>	-->
	   
                <p>
			<input id="valide" type="submit" name="forminscriptionstudio" value="Créer le profil" />
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



<!-- INSERT INTO `studio` (`id_studio`, `nom_studio`, `adresse_studio`, `telephone_studio`, `nombre_salle`, `email_studio`, `mdp_studio`) VALUES(NULL,'Local 15', '1 rue Raynouard', '0617501817', '3', 'rochfolly@hotmail.fr', 'yoyo') -->





