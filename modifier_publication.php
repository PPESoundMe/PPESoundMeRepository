<?php
	
	session_start();

	$bdd = new PDO('mysql:host=localhost;dbname=soundme', 'root', '');
	$modifstatut = $bdd->prepare('UPDATE actu SET description = ? WHERE id_actualite=?');
	$modifstatut->execute(array($_POST['suppressionchamp']));	

	header("Location:actualite.php?id_utilisateur=".$_SESSION['id_utilisateur']);


?>