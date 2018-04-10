<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);
session_start();




$pdo = new PDO('mysql:host=localhost;dbname=soundme', 'root','');

if(isset($_GET['id_studio']) AND $_GET['id_studio']>0)
{
  $getid = intval($_GET['id_studio']);
  $requser = $pdo->prepare('SELECT * FROM studio WHERE id_studio=?');
  $requser->execute(array($getid));
  $userinfo = $requser->fetch();


//if(isset($_POST['formajoutsalles']))
//{

    
    //$id2= intval($_GET['id_studio']);
   if(isset($_POST['formajoutsalles'])){

       $id2=$userinfo['id_studio'];
       $numero_salle = $_POST['numero_salle'];
       $surface_salle = $_POST['surface_salle'];
       $capacite = $_POST['capacite'];
       $prix_salle = $_POST['prix_salle'];

      
       if((isset($userinfo['id_studio'])) AND (!empty($_POST['numero_salle'])) AND (!empty($_POST['surface_salle'])) AND (!empty($_POST['capacite'])) AND (!empty($_POST['prix_salle'])))
       {    
      
          $insertsalle = $pdo->prepare("INSERT INTO salle (id_studio, nbr_max_personne, prix_salle, surface_salle, numero_salle) VALUES (?, ?, ?, ?, ?)");
          $insertsalle->execute(array($id2, $capacite, $prix_salle, $surface_salle, $numero_salle));
                          //$salleinfo = $insertsalle->fetch();    
        }  
       else { echo "Vous devez remplir tous les champs.";} 
   } 

    $salles = $pdo->query('SELECT * FROM salle');

    

}  

?>

<script>

function devoiler(bouton, id) { 
  
            var section = document.getElementById(id);

              if(section.style.display=="none") { // Si le div est masqué
             section.style.display = "block"; // on l'affiche
             bouton.innerHTML = "-"; // et on change le contenu du bouton.
             } 
  
              else { // S'il est visible
             section.style.display = "none"; // on le masque
             bouton.innerHTML = "+ Centres d'intérêts"; // ... et on change le contenu du bouton.
             }
            }
   
  </script> 


<html>
  <head>
    <title>Profil - SoundMe</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="photos/logo_onglet.ico">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="SoundMe Réseau Social">
      <meta name="keywords" content="SoundMe, music, rencontre, réseau, social, instrument, studio, réservation, apprendre, parametres">
      <meta name="author" content="PPE SoundMe">
        
        <!-- Feuilles de style  -->
    
        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="css/styleprofil.css">
   
        
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize/materialize.css"  media="screen,projection"/>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

         <!-- Bibliothèques JQuery  -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

         <!-- Compiled and minified CSS -->

      <!-- Compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
  </head>

  <header>
      <!-- NAVBAR DU HAUT  -->
  <nav class="transparent ">
  
    <div class="nav-wrapper ">
        <a href="#!" class="brand-logo right"><img src="photos/horizontal.png" width="600" alt=""></a>
 
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <form>
        <div class="input-field">
          <input id="search" type="search" required>
          <label class="label-icon" for="search"><i class="material-icons red-text text-accent-4">search</i></label>
        
        </div>
      </form>
      </ul>
  </div>
  </nav>
  </header>

      
    <body>
  
  <!-- NAVBAR DU BAS  -->   
    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li><div class="user-view">
          <div class="background">
            <img src="photos/fond.jpg">
          </div>
                    
                    <a href="profil.php?id_studio=<?php echo $_SESSION['id_studio']; ?>"><img class="circle hoverable modal-trigger" src="studios/couvertures/<?php if($userinfo['photostudio'] == NULL) { echo "defaut.jpg"; } else {  echo $userinfo['photostudio']; } ?>" href="#modal"></a>

                    <a href="#name"><span class="white-text name"><?php echo $userinfo['nom_studio'] ; ?></span></a>
                    <a href="#email"><span class="white-text email"><?php echo $userinfo['email_studio'] ;?></span></a>

        </div></li>

        <ul class="collapsible collapsible-accordion">
              <li>
                <a class="collapsible-header">Mon espace<i class="material-icons">arrow_drop_down</i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="#salles"?>"><i class="material-icons">music_note</i>Mes salles</a></li>
                    <li><a href="#"><i class="material-icons">today</i>Mon planning</a></li>


                  </ul>
                </div>
              </li>
            </ul>

            <li><a href="actualite.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">language</i>Actualités</a></li>
        <li><a href="#!"><i class="material-icons">location_on</i>Soundmap</a></li>
     
        <li><a href="parametres.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">settings</i>Paramètres</a></li>
        <li><a href="accueil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>"><i class="material-icons">settings_power</i>Déconnexion</a></li>

                <li><div class="divider"></div></li>
        <li><a class="subheader">Subheader</a></li>
        <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>

                       
                
        </ul>
            
            </nav>
        </aside>


    <main>

          <div class="container">

          <!-- CONTENU -->
            <div class="row"></div>
            

         </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="file" value="Charger une photo"><br></br>

           <div class="row">
              <div class="col s8"><img src="studios/couvertures/<?php if($userinfo['photostudio'] == NULL) { echo "defaut.jpg"; } else {  echo $userinfo['photostudio']; } ?>" class=" materialboxed pp left-align" data-caption="Photo de couverture du <?php echo $userinfo['nom_studio']; ?>" /></div>
              <div class="col s4">
                <h3> <?php echo $userinfo['nom_studio']; ?> </h3>
                <blockquote class="coucou">
                <ul class="grey-text">
                <li><h6><i class=" tiny material-icons">location_on</i> <?php echo $userinfo['adresse_studio']; ?></h6></li>
                <li><h6><i class=" tiny material-icons">phone</i> <?php echo $userinfo['telephone_studio']; ?></h6></li></h6></li>
                <li><h6><i class=" tiny material-icons">message</i> Messages </h6></li>
                <li><h6><i class=" tiny material-icons">settings</i> Paramètres </h6></li>
              </ul>
            </blockquote>

              </div>

          </div>

    <div class="card">

       <div class="card-tabs">
         <ul class="tabs tabs-fixed-width">
           <li class="tab"><a href="#salles" class="active">Salles</a></li>
           <li class="tab"><a href="#test2">Planning</a></li>

         </ul>
       </div>
      
       <div class="card-content grey lighten-4">

         <div id="salles">

             <h4>Ce studio dispose de <?php echo $userinfo['nombre_salle'] ?> salles d'enregistrement.</h4>
            
             <?php
             while($infos=$salles->fetch()){                      
             ?>
             <div id=afiichesalle">
             <p class="numero"> Salle n°<?php echo $infos['numero_salle'] ?></p>
             <p class="description">Surface: <?php echo $infos['surface_salle'] ?> m² </p>
             <p class="description">Capacité: <?php echo $infos["nbr_max_personne"] ?> personnes </p>
             <p class="description">Prix horaire: <?php echo $infos["prix_salle"] ?> €/heure </p>
             </br></br>

          

             <?php
             }

             $salles->closeCursor(); // Termine le traitement de la requête

             ?>
             </div>


            <button type="button" onclick="devoiler(this,'affichable');">+ Ajouter une salle</button>
              <div id="affichable" style="display:none;">

             <form method="POST" action="" >
                         
                    
                <table>
              <tr>
                  <td><label>Numéro de la salle : </label></td>
                  <td><input type="text" name="numero_salle" id="numero_salle" class="formsalle" /></td>
            
              </tr>
              
              <tr>
                  <td><label>Surface : </label></td>
                  <td><input type="text" name="surface_salle" id="surface_salle" class="formsalle" /><p> m²</p></td>
            
              </tr>
            <tr>
                <td><label>Capacité : </label></td>
                <td><input type="text" name="capacite" id="capacite" class="formsalle" /><p> personnnes</p></td>
              </tr>
            
              <tr>
                  <td><label>Prix Horaire : </label></td>
                  <td><input type="text" name="prix_salle" id="prix_salle" class="formsalle" /><p>€/heure</td>
              </tr>

              <tr>
                  <td><input type="submit" value="Ajouter" name="formajoutsalles" /></td>
              </tr>
            </table>


            
        </form>


         </div>

       </div>

        <div id="test2">
          
        </div>
      

      

    

           <?php  /*

             if(!empty $userinfo['photostudio'])
             {
                    
              <img src= "photos/couvstudios/<?php echo $userinfo['photostudio']; ?>" width="auto" height="320" /> 
                     
             }  
                 */
          ?> 




          <!-- <h4>Ajouter une photo de couverture</h4>
          <form method="POST" action="   " enctype="multipart/form-data">

          <input type="file" id="photostudio" name="photostudio" value="Parcourir" />
          <input type="submit" id="valide" name="photocouverture" value="Upload" />
          </form>  -->
     

      
         <?php 
          /*
         $salles = $pdo->query('SELECT * FROM Salle WHERE id_studio=$_SESSION['id_studio']');
      
         while($donnees = $salles->fetch())
         {
          ?>
            <p class="salle">Salle n° <?php echo $donnees['numero_salle'] ?></p>
            <p class="description">
             Surface: <?php echo $donnees['surface_salle'] ?> m²
             Capacité: <?php echo $donnees["nbr_max_personnes"] ?> personnes
             Prix horaire: <?php echo $donnees["prix_salle"] ?> €
            </p>

          <?php
          }

            */

          ?>

    
       </div>

       

       <div id="planning">

  

       </div>

      </main>

    </body>

</html>