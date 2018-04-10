<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);
session_start();




$pdo = new PDO('mysql:host=localhost;dbname=soundme', 'root','');

if(isset($_GET['id_studio']) AND $_GET['id_studio']>0)
{
  $getid = intval($_GET['id_studio']);
  $reqstudio = $pdo->prepare('SELECT * FROM Studio WHERE id_studio=?');
  $reqstudio->execute(array($getid));
  $userinfo = $reqstudio->fetch();
}


?>
    


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
                    <li><a href="salles.php?id_studio=<?php echo $_SESSION['id_studio']; ?>"><i class="material-icons">music_note</i>Mes salles</a></li>
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
        <li class="tab"><a href="#test1" class="active">Salles</a></li>
          

        <li class="tab"><a href="#test2">Evènements</a></li>

      </ul>

      <div id="salles"> 

         <h4>Ce studio dispose de <?php echo $userinfo['nombre_salle'] ?> salles d'enregistrement.</h4>
         <a href="ajoutsalles.php?id_studio=<?php echo $_SESSION['id_studio']; ?>">Ajouter une salle</a></div>
    

           <?php  /*

             if(!empty $userinfo['photostudio'])
             {
                    
              <img src= "photos/couvstudios/<?php echo $userinfo['photostudio']; ?>" width="auto" height="320" /> 
                     
             }  
                 */
          ?> 




          <h4>Ajouter une photo de couverture</h4>
          <form method="POST" action="   " enctype="multipart/form-data">

          <input type="file" id="photostudio" name="photostudio" value="Parcourir" />
          <input type="submit" id="valide" name="photocouverture" value="Upload" />
          </form>

      </div>

      
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