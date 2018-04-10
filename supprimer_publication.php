<?php
	
	session_start();

	$bdd = new PDO('mysql:host=localhost;dbname=soundme', 'root', 'root');
	$supprimestatut = $bdd->prepare('DELETE FROM actu WHERE id_actualite=?');
	$supprimestatut->execute(array($_POST['suppressionchamp']));	

	header("Location:actualite.php?id_utilisateur=".$_SESSION['id_utilisateur']);


?>