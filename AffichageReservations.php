<?php

$bdd = new PDO('mysql:host=localhost;dbname=soundme','root','');

$affichage = $bdd->prepare("SELECT * FROM Reservation WHERE id_utilisateur=?");
$affichage->execute(array("1"));


while ($donnees = $affichage->fetch())
{
    //On affiche les données dans le tableau
    echo "</tr>";
    echo "<td> $donnees[jour] </td>";
    echo "<td> $donnees[heure_debut] </td>";
    echo "<td> $donnees[heure_fin] </td>";
    echo "</tr> <br>";


}


?>
