<?php
require('../../bdd.php');

if(isset($_GET['id'])){

	$id_billet = intval($_GET['id']);

	$req = $connexion ->prepare("SELECT * FROM billets WHERE id_billet = ?");
	$req ->execute(array($id_billet));
	$donnee = $req->fetch();

}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Modifier le Billet</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<script src="assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet"type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
   <h1>Modification du billet</h1>
    <form method="POST" action="#" class="form-group">
     <div class="container">
     	 <label for="titre">Titre</label><br>
	    	<input type="text" name="title" class="form-control" id="titre" value="<?=$donnee['titre'];?>"><br><br>

	    	<label for="contenu">Message</label><br>
	    	<textarea cols="5" rows="10" id="contenu" name="contenu" class="form-control"><?=nl2br($donnee['contenu']);?></textarea>

    <button type="submit" name="valider" class="btn btn-success btn-lg">Valider</button>
    <a href="index.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span> Menu</a>
     </div>
    </form>
<?php



if(isset($_POST['valider']) && !empty($_POST['title']) && !empty($_POST['contenu'])){
 
	$title = htmlspecialchars($_POST['title']);
	$contenu = htmlspecialchars($_POST['contenu']);
	$req = $connexion->prepare("UPDATE billets SET titre = ? , contenu = ? WHERE id_billet = ?");
    $req->execute(array($title,$contenu,$id_billet));
      echo "<p class='alert alert-success'>Le Billet a été Modifié  Avec success </p>";
    $req->closeCursor();
}




?>



</body>
</html>