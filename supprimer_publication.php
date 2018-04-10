<<<<<<< HEAD
<?php
	
	session_start();

	$bdd = new PDO('mysql:host=localhost;dbname=soundme', 'root', 'root');
	$supprimestatut = $bdd->prepare('DELETE FROM actu WHERE id_actualite=?');
	$supprimestatut->execute(array($_POST['suppressionchamp']));	

	header("Location:actualite.php?id_utilisateur=".$_SESSION['id_utilisateur']);


=======
<?php
	
	session_start();

	$bdd = new PDO('mysql:host=localhost;dbname=soundme', 'root', '');
	$supprimestatut = $bdd->prepare('DELETE FROM actu WHERE id_actualite=?');
	$supprimestatut->execute(array($_POST['suppressionchamp']));	

	header("Location:actualite.php?id_utilisateur=".$_SESSION['id_utilisateur']);


>>>>>>> ba95a580443475c17a5407c71e5187fa3a60805a
?>