<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=soundme', 'root', 'root');

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
			
			<div class="slider fullscreen">
    <ul class="slides">

      <li>
        <img src="photos/fond.jpg"> <!-- random image -->
        <div class="caption center-align">
          <h3>Bienvenue sur SoundMe</h3>
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
          <h3>Partagez votre passion</h3>
          <h5 class="light grey-text text-lighten-3">C'est simple comme bonjour.</h5>
          

        </div>
      </li>
     
    </ul>
  </div>

<script type="text/javascript">
	 $(document).ready(function(){
      $('.slider').slider({full_width: true});
    });
</script>
			

                
  
				
              
          
		    </form>
			
        </main>	
			
	</body>
</html>