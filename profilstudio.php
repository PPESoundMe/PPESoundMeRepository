<?php
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
      <!-- Feuilles de style  -->
      <link rel="stylesheet" href="style/css/styleparametre.css">
        <link rel="stylesheet" href="style/css/stylenavbar.css">
        <link href="style/css/hover-min.css" rel="stylesheet">
        
        <!-- Ajout du js pour la navbar  -->
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(e){
                $('.has-sub').click(function(){
                    $(this).toggleClass('tap');
                })
            })
        </script>
    </head> 
    
    <!-- Headerlogo  -->
    <header> 
      <figure>
        <img src="style/photos/noteblanche.png" alt="logoSoundMe">
      </figure>
    </header>
      
    <!-- Début du menu sur le côté  -->
        <aside>
            
            <!-- Barre de recherche  -->
            <nav class="main-nav">
                <form action="">
                    <input id="barnav" type = "text" name="" placeholder="RECHERCHE...">
                </form>
                <ul class="main-nav-ul">
                    
                    <li class="has-sub"><a href="profilstudio.php?id_studio=<?php echo $_SESSION['id_studio']; ?>">Profil<span class="sub-arrow"></span></a>
                       

                    </li>
                    <li><a href="actualite.php?id_studio=<?php echo $_SESSION['id_studio']; ?>">Actualités</a></li>
                    <li><a href="carte.php">SoundMap</a></li>
                    
                  
      
                    <li><a href="parametrestudio.php?id_studio=<?php echo $_SESSION['id_studio']; ?>">Paramètres</a></li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                
                </ul>
            
            </nav>
        </aside>


    <body>

      <div id="base">

           <?php

             if(!empty $userinfo['photostudio'])
             {

              <img src= "photos/couvstudios/<?php echo $userinfo['photostudio']; ?>" width="auto" height="320" /> 

             }  

          ?> 


          <h1><strong><?php echo $userinfo['nom_studio']; ?></strong></h1></br>
          <?php echo $userinfo['adresse_studio']; ?></br>
          <?php echo $userinfo['telephone_studio']; ?>

          <h4>Ajouter une photo de couverture</h4>
          <form method="POST" action="   " enctype="multipart/form-data">

          <input type="file" id="photostudio" name="photostudio" value="Parcourir" />
          <input type="submit" id="valide" name="photocouverture" value="Upload" />
          </form>

      </div>

      <div id="salles"> 

         <h2>Ce studio dispose de <?php echo $userinfo['nombre_salle'] ?> salles d'enregistrement.</h2>
         <a href="ajoutsalles.php?id_studio=<?php echo $_SESSION['id_studio']; ?>">Ajouter une salle</a>

         <?php 

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
          ?>

    
       </div>

       

       <div id="planning">

  

       </div>

    </body>

</html>