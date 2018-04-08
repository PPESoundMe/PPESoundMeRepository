<?php>

<html>
	<head>

	
		<meta charset="utf-8">
	   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<meta name="description" content="SoundMe Réseau Social">
	    <meta name="keywords" content="SoundMe, music, rencontre, réseau, social, instrument, studio, réservation, apprendre, parametres">
	    <meta name="author" content="PPE SoundMe">
        
        <!-- Feuilles de style  -->
	    <link rel="stylesheet" href="style/css/styleparametre.css">
        <link rel="stylesheet" href="style/css/stylenavbar.css">
        <link href="css/hover-min.css" rel="stylesheet">
	    
        <!-- Titre  -->
	    <title>Paramètres</title>    
	</head>
	
	<body>
        <!-- Headerlogo  -->
        <header> 
            <figure>
                <img src="style/photos/noteblanche.png" alt="logoSoundMe">
            </figure>
        </header>
        
        
        <!-- Début du menu sur le côté  -->
        <aside>
            <div class="menu">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">bjaa</a>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Home</a></li>
                        </ul>

                    </li>
                    <li><a href="#">Hofearme</a></li>
                    <li><a href="#">frfear</a></li>
                    <li><a href="#">frfear</a></li>
                    <li><a href="#">frfear</a></li>
                
                </ul>
            
            </div>
        </aside>
        
        
         
	   <main>
		<h1>Ajouter une salle</h1>		

        <form method="POST" action="profilstudio.php" >
                         
                    
          <table>
              <tr>
                  <td><label>Numéro de la salle : </label></td>
                  <td><input type="text" name="numero_salle" ?>" /></td>
            
              </tr>
              
              <tr>
                  <td><label>Surface : </label></td>
                  <td><input type="text" name="surface_salle" /><p> m²</p></td>
            
              </tr>
            <tr>
                <td><label>Capacité : </label></td>
                <td><input type="text" name="capacité" /><p> personnnes</p></td>
              </tr>
            
              <tr>
                  <td><label>Prix Horaire : </label></td>
                  <td><input type="text" name="prix_salle" /></td>
              </tr>
            </table>
            
        </form>