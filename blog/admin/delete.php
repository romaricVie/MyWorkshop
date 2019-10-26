<?php
require('../../bdd.php');

if(isset($_GET['id'])){
	$id_billet = $_GET['id'];
	if(isset($_POST['yes'])){
		$req = $connexion->prepare("DELETE FROM billets WHERE id_billet = ?");
		$req->execute(array($id_billet));
		echo "<p class='alert alert-success'>Le billet a été supprimer avec success! </p>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>suppression de billet</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<script src="assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet"type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
 <?php
        $req = $connexion->prepare("SELECT * FROM billets WHERE id_billet = ? ");
        $req->execute(array($id_billet));
        $donnee = $req->fetch();
	?>
 <form method="POST" action="#">
	 <div class="container">
                      <div class="thumbnail">
		         	   	   <h3><?= $donnee['titre'];?>
	     	                       <em><?= $donnee['date_creation'] ?></em>
	     	                          </h3>
		         	   	    	   	   <p ><?= nl2br($donnee['contenu'])?><P>
		         	   	    	   	 <div class="caption">
		         	   	    	   	    <a href="index.php" class="btn btn-primary "role="button"><span class=""></span>Annuler</a>
		         	   	    	   	    <button type="submit" name="yes" class="btn btn-danger">
		         	   	    	   	    	<span class="glyphicon glyphicon-remove"></span> Supprimer</a>
		         	   	    	   	    </button>
		         	   	    	   	  </div>
	         	   	         </div>  
                      </div>	         	   	    	
 </form>
</body>
</html>

