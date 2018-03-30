<?php

$bdd = new PDO('mysql:host=localhost;dbname=soundme','root','');

if(isset($_POST['valideReservation'])){

  $idUtilisateur = "1";
  $idStudio = "1";
  $jourReservation = htmlspecialchars($_POST['jourReservation']);
  $heureReservation = htmlspecialchars($_POST['heureReservation']);
  $heureFinReservation = htmlspecialchars($_POST['heureFinReservation']);
  $nbSalleReservation = htmlspecialchars($_POST['nbSalleReservation']);
  $nbPersReservation = htmlspecialchars($_POST['nbPersReservation']);
  $materielReservation = htmlspecialchars($_POST['materielReservation']);

  $insertReservation = $bdd->prepare("INSERT INTO Reservation(id_utilisateur, jour, heure_debut,
						heure_fin, id_salle, id_studio, nombre_personne,
                        nom_type_materiel, prix_reservation)
	VALUES (?,?,?,?,?,?,?,?,?)");
  //$insertReservation->execute("1", "2018-3-18", "08:00", "09:00", "1", "1", "1", "null", "50");
  $insertReservation->execute(array($idUtilisateur, $jourReservation, $heureReservation, $heureFinReservation,
  $nbSalleReservation, "1", $nbPersReservation, $materielReservation, "50"));

}


?>


<html>
<head>
<link href="../css/reservation.css" type="text/css" rel="stylesheet" />
<title>Réserver vos créneaux</title>
</head>
<body>

  <main>
    <form method="post" action="">
      <section>
        <h3>Salle</h3>
        <select name="$nbSalleReservation">
          <option value=1>Salle n°1</option>
          <option value=2>Salle n°2</option>
          <option value=3>Salle n°3</option>
          <option value=4>Salle n°4</option>
        </select>
      </section>

      <section>
        <h3>Date</h3>
        <label>Jour</label>
        <input type="date" name="jourReservation" value="<?php echo date('Y-m-d'); ?>">
        <label>Heure début</label>
        <input type="time" name="heureReservation" value="08:00">
        <label>Heure fin</label>
        <input type="time" name="heureFinReservation" value="09:00">
      </section>

      <section>
        <h3>Nombre de personne</h3>
        <input type="number" name="nbPersReservation" value="1">
      </section>

      <section>
        <h3>Choix du matériel</h3>
        <input type="text" name="materielReservation" value="">
      </section>

      <section>
        <input type="submit" name="valideReservation" value="Je réserve">
      </section>

    </form>
  </main>





</body>
</html>
