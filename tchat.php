<?php
session_start();

require ('bdd.php');
require('function.php');

if(isset($_GET['id'])){
  $getid = intval($_GET['id']);

  $req = $connexion -> prepare("SELECT * FROM membres WHERE id = ?");

  $req -> execute(array($getid));
  $userinfos = $req -> fetch();

$req ->closeCursor();
}



//if($_SESSION['id'] AND $userinfos['id'] == $_SESSION['id']){

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Bienvenue || Tchat</title>
	<meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="assets/bootstrap/js/bootstrap.min.js"></script><!--Bootstrap-->
    <script src="assets/jquery/jquery-3.3.1.min.js"></script><!--Jquery-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"><!--css-->
    <link rel="stylesheet" type="text/css" href="">
</head>
<body>
   <a href="profil.php?id=<?=$_SESSION['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Mon profil</a>
   <a href="user_online.php" class="btn btn-success"><span class="glyphicon glyphicon-user"></span> Utilisateurs en ligne</a>
  <h1 style="color:blue; text-align:center ">Bienvenue <?=$_SESSION['psuedo']?>, Sur notre plateforme de Tchat</h1>
 

  <div id="messages" style="text-align: center">

  <?php
  // Afficher les messages.....

    $req = $connexion -> query("SELECT psuedo, message, DATE_FORMAT(date,'%d/%m/%Y %Hh%imin%ss') AS date FROM tchat ORDER BY id ASC");
   
   while($donnee = $req -> fetch()){
    echo "<strong>".$donnee['psuedo'].":</strong> <br/>".$donnee['message']."<br/>  <span class='glyphicon glyphicon-time'></span> ".$donnee['date']."<br>";
   }
  $req ->closeCursor();

     ?>

   </div>
 
   <nav class="navbar  navbar-fixed-bottom">
     <form action="#" method="POST">
          <textarea class="form-control" name="message" placeholder="Votre message texte"></textarea><br>
          <input type="submit" name="tchat" value="Tchatter" class="btn btn-success"><br><br>

      </form>
    </nav>

<?php


if(isset($_POST['tchat'])){
   if(!empty($_POST['message'])){
     $message = InputUser($_POST['message']);
      // insertion du  du tchat
     $req = $connexion -> prepare("INSERT INTO tchat(psuedo,message) VALUES(?,?)");
     $req -> execute(array($_SESSION['psuedo'],$message));
     $req ->closeCursor();

   }
} 
 



 ?>

<!--Function JavaScript permattant d'actualiser le code a un interval de temps requilier-->
<script type="text/javascript">
  
setInterval('load_messages()',500); // param1: nom de la fonction, param2: temps pour actualiser
function load_messages() {
  $("#messages").load('function.affiche.php'); // le code à actualiser 
  
}
    

</script>
</body>
</html>












