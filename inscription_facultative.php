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

$pdo = new PDO('mysql:host=localhost;dbname=soundme','root','root');

echo $_SESSION['id_utilisateur'];

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur']>0)
{
    $getid = intval($_GET['id_utilisateur']);
    $requser = $pdo->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur=?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
}

if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur']==$_SESSION['id_utilisateur'])
{
    $requser = $pdo->prepare("SELECT * FROM Utilisateur WHERE id_utilisateur=?");
    $requser->execute(array($_SESSION['id_utilisateur']));
    $user = $requser->fetch();

    if(isset($_POST['forminscription']))
    {
           if(isset($_POST['adress']) AND !empty($_POST['adress']) AND $_POST['adress']!=$user['adresse'])
            {
                $adress = htmlspecialchars($_POST['adress']);
                $insertadress = $pdo->prepare("UPDATE Utilisateur SET adresse = ? WHERE id_utilisateur = ?");
                $insertadress->execute(array($adress,$_SESSION['id_utilisateur']));

               
            } 
            header("Location:profil.php?id_utilisateur=".$_SESSION['id_utilisateur']);
    }
}

    


?>

<!-- Début HTML  -->
<html>
	<head>
		
	           <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="SoundMe Réseau Social">
        <meta name="keywords" content="SoundMe, music, rencontre, réseau, social, instrument, studio, réservation, apprendre">
        <meta name="author" content="PPE SoundMe">
            
        <!-- Feuille de style  -->
        <link rel="stylesheet" href="css/stylelogin.css">
        <link rel="stylesheet" href="css/default.css">

         <!-- Feuilles de style  -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

         <!-- Bibliothèques JQuery  -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

        
        <!-- Titre  -->
	    <title>Inscription facultative</title> 
	</head>
	
	<body>
        
        
        <!-- Header logo  -->
       <header> 
                <figure>

                  
                    <a href="accueil.php" class="  "><img src="photos/noteblanche.png" alt="logoSoundMe"></a> 

                </figure>
            </header>
        
        
        <!-- Box d'inscriptino  -->
       <div class="container">

            <div class="box">
		<h1>Inscription facultative</h1>
        <h2 grey>Vous pouvez ignorer cette étape ou y revenir plus tard.</h2>
	
		
        <!-- Formulaire  -->         
            <!-- Profil musical  -->
            <form method="POST" action ="">
		
		<hr>
            <section>
                <h3>Profil musical</h3>
                <label for="prenom">Profil</label>

                <ol>
                    <li>
                        <input type="checkbox" id="chanteur" name="activite" value="chanteur">
                         <label for="chanteur">Chanteur</label>
                    </li>
                    <li>
                        <input type="checkbox" id="DJ" name="activite" value="DJ">
                         <label for="DJ">DJ</label>
                    </li>

                    <li>
                         <input type="checkbox" id="musicien" name="activite" value="musicien">
                         <label for="musicien">Musicien</label>
                    </li>
                </ol>
            </section>
         
            <!-- Niveau  -->
            <section>
                    <hr>
                    <h3>Niveau</h3> 
                        <select name="niveau" size="1">
                            <option>Débutant <option>Intermédiaire <option>Avancé <option>Professionnel 
                        </select>
                </section>
            
                
            <!-- Instruments  -->
                <section>
				    <hr>
                    <h3>Instruments</h3> 
					
                    <table>
                       <tr>
                           <td><input type="checkbox" id="Guitare" name="activite" value="Guitare">
                             <label for="Guitare">Guitare </label></td>
                           
                           <td><input type="checkbox" id="Piano" name="activite" value="Piano">
                             <label for="Piano">Piano</label></td>
                           
                           <td><input type="checkbox" id="Batterie" name="activite" value="Batterie">
                             <label for="Batterie">Batterie</label></td>
                       </tr>
                       <tr>
                           <td><input type="checkbox" id="Basse" name="activite" value="Basse">
                             <label for="Basse">Basse</label></td>
                           
                           <td><input type="checkbox" id="Violon" name="activite" value="Violon">
                             <label for="Violon">Violon</label></td>
                           <td><input type="checkbox" id="Flûte" name="activite" value="Flûte">
                             <label for="Flûte">Flûte</label></td>
                       </tr>
                        
                        <tr>
                           <td><input type="checkbox" id="Trompette" name="activite" value="Trompette">
                             <label for="Trompette">Trompette</label></td>
                           
                           <td><input type="checkbox" id="Harpe" name="activite" value="Harpe">
                             <label for="Harpe">Harpe</label></td>
                            
                           <td><input type="checkbox" id="Saxophone" name="activite" value="Saxophone">
                             <label for="Saxophone">Saxophone</label></td>
                       </tr>
                        
                        <tr>
                           <td><input type="checkbox" id="Violoncelle" name="activite" value="Violoncelle">
                             <label for="Violoncelle">Violoncelle</label></td>
                           
                           <td><input type="checkbox" id="Triangle" name="activite" value="Triangle">
                             <label for="Triangle">Triangle</label></td>
                            
                           <td><input type="checkbox" id="Contrebasse" name="activite" value="Contrebasse">
                             <label for="Contrebasse">Contrebasse</label></td>
                       </tr>
                    </table>
                    

            </section>
				
<!-- Styles de musiques favoris  -->
            <section>
                <hr>
                <h3>Styles musicaux favoris </h3> 
                <ul>
                
                    <li><input type="checkbox" name="rock" value="rock">Rock</li>
                    <li><input type="checkbox" name="hiphop" value="hiphop">Hip-Hop</li>
                    <li><input type="checkbox" name="pop" value="pop">Pop</li>
                    <li><input type="checkbox" name="jazz" value="jazz">Jazz</li>
                    <li><input type="checkbox" name="rap" value="rap">Rap</li>
                    <li><input type="checkbox" name="rnb" value="rnb">R'n'B</li>
                    <li><input type="checkbox" name="metal" value="metal">Metal</li>
                    <li><input type="checkbox" name="classique" value="classique">Musique classique</li>
                    <li><input type="checkbox" name="house" value="house">House</li>
                    <li><input type="checkbox" name="opera" value="opera">Opéra</li>
                    <li><input type="checkbox" name="dubstep" value="dubstep">Dubstep</li>
                    <li><input type="checkbox" name="techno" value="techno">Techno</li>
                    <li><input type="checkbox" name="transe" value="transe">Transe</li>
                    <li><input type="checkbox" name="country" value="country">Country</li>
                </ul>
            </section>
        
				
<!-- Adresse ou arrondissement  -->
                <section>
                    <hr>
                    <h3>Adresse ou arondissement </h3> 
                    <p>
						<input type="adress" placeholder="Votre adresse" id="adresse" name="adresse" />
                    </p>
                 
                    
                </section>
						
                	
<!-- Ce que vous attendez de soundme  -->
                    <hr>
                   <h3>Objectifs</h3>
                    <section id="objectifs">
                    <div class="lol"><textarea name="objectifs" id="objectifs" rows="10" cols="50" placeholder="Que recherches-tu ?"></textarea></div>
		                <div class="row">

        <div class="input-field col s12">
          <i class="material-icons prefix">mode_edit</i>
          <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
          <label for="icon_prefix2">Que recherches-tu ?</label>
        </div>
      </div>

  </div>
                    </section>	
	   
  <section>             
            <!-- Bouton validation  -->
			<input id="valide" type="submit" name="forminscription" value="Confirmer" />
                    
            <!-- Bouton ignorer  -->
            
            <a id="valide" href="profil.php?id_utilisateur=<?php echo $_SESSION['id_utilisateur']; ?>">Ignorer cette étape</a>
       
</section>
        </form>
	   </div>
     </div>
 </div>

        <script>
    function find_adress() {

        var input = document.getElementById('adress');

        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
          
          var place = autocomplete.getPlace();

          document.getElementById('place-id').textContent = place.place_id;
          document.getElementById('place-address').textContent =
              place.formatted_address;
        });
      }
    </script>   
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBesfXDKzNyZPcB2Nr-F8DoeFg2kCCDbiQ&libraries=places&callback=find_adress"
        async defer></script>

	</body>
</html>
