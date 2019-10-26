<?php
session_start();
// Page de suppression du compte
require('bdd.php');

if(isset($_SESSION['id'])){
  $requser = $connexion->prepare("SELECT * FROM membres WHERE id = ?");
  $requser -> execute(array($_SESSION['id']));
  $user = $requser -> fetch();
 
if(isset($_POST['yes'])){
 
 $requser = $connexion -> prepare("DELETE FROM membres WHERE id = ?");
	 try
	   {
	   	  $requser -> execute(array($_SESSION['id']));
	   	  echo "<p class='alert alert-success'>votre compte a été supprimé </p>";
	   	  header('location:register.php');
	   }
   catch(Exception $e){
	   	echo "Erreur de Suppression de compte : ".$e->getMessage();
	   }


}

?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>supprimer mon compte</title>
	 <meta name="viewport" content="width=device-width,initial-scale=1">
  <script src="assets/jquery/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <form action="" method="POST">
    	<div class="container">
    		<p>Voulez-vous supprimer le compte de <strong><?= $user['psuedo'];?></strong>?</p>
		    	<div class="form-action alert alert-warning">
		    		<button type="submit" class="btn btn-danger" name="yes">OUI</button>
		    		<?php
		                echo "<a href='profil.php?id=".$_SESSION['id']."'class='btn btn-default'>Annuler</a>";
		    		?>
		    	</div>
    	</div>
    	
    	
    </form>
</body>
</html>
<?php
}
else{
  header('location:connexion.php');
}
$requser->closeCursor();

?>
