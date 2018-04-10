<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=soundme', 'root', '');

?>

<!-- Début HTML  -->

<html>
	<head>
	    <meta charset="utf-8">
	   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<meta name="description" content="SoundMe Réseau Social">
	    <meta name="keywords" content="SoundMe, music, rencontre, réseau, social, instrument, studio, réservation, apprendre">
	    <meta name="author" content="PPE SoundMe">
      <link rel="shortcut icon" href="photos/logo_onglet.ico">

        
        <!-- Feuilles de style  -->
	    <link rel="stylesheet" href="css/styleaccueil.css">
        <link href="css/hover-min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

         <!-- Bibliothèques JQuery  -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
		

	    
        <!-- Titre  -->
	    <title>SoundMe</title>    
  </head>

	<body>
        
        
        <!-- Headerlogo  -->
        <header> 
            <figure>
                <img src="photos/noteblanche.png" alt="logoSoundMe">
            </figure>
        </header>
        
        <!-- Box de connexion  -->
		<main>
			
			<div class="slider" >
    <ul class="slides">

      <li>
        <img src="photos/fond.jpg"> <!-- random image -->
        <div class="caption center-align">
          <h1>Bienvenue sur SoundMe !</h1>
          <h5 class="light grey-text text-lighten-3">Rejoignez l'aventure.</h5>
          
          <div class="box">

            <a href="inscription.php" class="waves-effect waves-light btn  red accent-3">Inscription</a>
            <a href="connexion.php" class="waves-effect waves-light btn  red accent-3">Connexion</a>
            

	  
	       </div>
        </div>
      </li>


      <li>
        <img src="photos/guitar.jpg"> <!-- random image -->
        <div class="caption left-align">
          <h1>Partagez votre passion</h1>
          <h5 class="light grey-text text-lighten-3">C'est simple comme bonjour.</h5>
          

        </div>
      </li>
     
    </ul>

    <div class="section grey lighten-3">
      <div class="row container">
        <h1 class="header">SoundMe : qu'est-ce que c'est ?</h1>
              <div class="row">
                  <div class="col s4 center-align">
                    <div class="block center-align">
                      <i class="center-align large material-icons hovicon effect-1 sub-a">music_note</i>
                    </div>
                  <p class="flow-text light grey-text">Partagez avec d'autres musiciens</p>
                  </div>


                <div class="col s4 center-align">
                    <div class="block center-align">
                        <i class="center-align large material-icons hovicon effect-1 sub-a">group</i>
                    </div>
                    <p class="flow-text light grey-text">Créez des groupes de musique</p>
                </div>
              <div class="col s4 center-align">
                <div class="block center-align">
                        <i class="center-align large material-icons hovicon effect-1 sub-a">headset</i>
                    </div>
                <p class="flow-text light grey-text ">Réservez des studios de musique en ligne</p>
              </div>

            </div>
        
        </div>

         

<script type="text/javascript">
	 $(document).ready(function(){
      $('.slider').slider({full_width: true});
    });
     $('.carousel.carousel-slider').carousel({
    fullWidth: true
  });
</script>
			

                
  
				
              
          
		    </form>
			
        </main>	
			
	</body>
</html>