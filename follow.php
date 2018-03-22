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


$getfollowedid = intval($_GET['followedid']);

if($getfollowedid != $_SESSION['id_utilisateur'])
{
	$dejafollowed = $pdo->prepare('SELECT * FROM Abonnement WHERE id_abonne = ? AND id_suivi=?');
	$dejafollowed->execute(array($_SESSION['id_utilisateur'],$getfollowedid));
	$dejafollowed = $dejafollowed->rowCount();
	
	if($dejafollowed == 0)
	{
		$addfollow = $pdo->prepare('INSERT INTO Abonnement(id_abonne,id_suivi) VALUES (?,?)') ;
		$addfollow->execute(array($_SESSION['id_utilisateur'],$getfollowedid));
	}
	
	elseif($dejafollowed ==1)
	{
		$deletefollow = $pdo->prepare('DELETE FROM Abonnement WHERE id_abonne=? AND id_suivi=?');
		$deletefollow->execute(array($_SESSION['id_utilisateur'],$getfollowedid));
	}
}

header('Location:'.$_SERVER['HTTP_REFERER']);

?>