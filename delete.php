<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=soundme', 'root', 'root');

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
	$suppr_id = htmlspecialchars($_GET['id_utilisateur']);



	$suppr = $bdd->prepare('DELETE * FROM utilisateur WHERE id_utilisateur=?');
	$suppr -> execute(array($suppr_id));
	header("Location:actualite.php?id_utilisateur=".$_SESSION['id_utilisateur']);
}