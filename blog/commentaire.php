<?php
session_start();
require('bdd.php');

// recup id


?>
<!DOCTYPE html>
<html>
<head>
	<title>commentaire</title>
	<meta charset="utf-8">
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <script src="assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet"type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

  <h1>Commentaire de blog!</h1>
  <a href="index.php?id=<?=$_SESSION['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> retour au menu</a>
  
<?php

  if(isset($_GET['billet']) AND !empty($_GET['billet']) AND $_GET['billet'] > 0){
    
    $_GET['billet'] = intval($_GET['billet']);
    $_SESSION['id'] = $_GET['billet'];

    
    // Affiche le billet
    $req = $connexion -> prepare("SELECT id_billet, titre, contenu, DATE_FORMAT(date_creation,'%d/%m/%Y %Hh%imin%ss') AS date FROM billets WHERE id_billet = ? ");
    $req -> execute(array($_GET['billet']));

  $donnee = $req -> fetch();
  ?>

    <div class="news">
        <h3><?= $donnee['titre'];?>
             <em>le <?= $donnee['date'] ?></em>
        </h3>
      <p>
        <?= nl2br($donnee['contenu'])?>
      
         <br/>
             
         </p>
     </div>

    <h2>Commentaires</h2>

  <div id="messages">
  <?php
  $req -> closeCursor();
  }

  // requete pour afficher les commentaires
 
  $req = $connexion -> prepare("SELECT id_commentaire,  auteur, DATE_FORMAT(date_commentaire, '%d/%m/%Y %Hh%imin%ss') AS date, commentaire FROM commentaires WHERE id_billet = ? ORDER BY date");

$req ->execute(array($_GET['billet']));

while ($donnee = $req -> fetch()){
  ?> 

  <div class="container" >
         <p><strong><?= $donnee['auteur']?></strong></p>
          <p>
              <?= $donnee['commentaire']?>
           </p>
      <p><span class="glyphicon glyphicon-time"></span>  <?= $donnee['date']?></p>
    
        
  </div>
  
  <?php
}

$req->closeCursor();

?>
 </div>

<form action="#" method="POST">
  <fieldset style="width: 50%;margin-left:20%" class="form-group">
        <label for="psuedo">Psuedo</label><br>
        <input type="text" id="psuedo" name="psuedo" value="" placeholder="entrez votre psuedo" class="form-control"><br><br>
        <label for="comment">Message</label><br>
        <textarea id="comment" rows="10" cols="50" for="comment" name="message" placeholder="votre commentaire..."class="form-control"></textarea><br>
        <button type="submit" value="commenter" name="submit" class="btn btn-primary bt-md">Message</button>
    </fieldset>

</form>

<?php
if(isset($_POST['submit'])){
  if(!empty($_POST['psuedo'] AND $_POST['message'])){

    $psuedo = $_POST['psuedo'];
   $message = $_POST['message'];

   // Inserer un nouveau commentaire
   
   $req = $connexion -> prepare("INSERT INTO commentaires(id_billet,auteur,commentaire) VALUES(?,?,?)");
   $req -> execute(array($_GET['billet'],$psuedo,$message));
   $req -> closeCursor();


  }else{
    header('location:index.php');
  }
}

?>

<script type="text/javascript">
   
setInterval('load_messages()',500); // param1: nom de la fonction, param2: temps pour actualiser
function load_messages() {
  $("#messages").load('actualise.php'); // le code à actualiser 
  
}

</script>

</body>
</html>