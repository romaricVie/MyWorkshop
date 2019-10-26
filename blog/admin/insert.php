<?php
require('../../bdd.php');

if(isset($_POST['valider']) && !empty($_POST['title']) && !empty($_POST['contenu'])){

	$title = htmlspecialchars($_POST['title']);
	$contenu = htmlspecialchars($_POST['contenu']);
	$req = $connexion->prepare("INSERT INTO billets (titre,contenu) VALUES(?,?)");
    $req->execute(array($title,$contenu));
      echo "<p class='alert alert-success'>Ajout de Billet effectué avec success </p>";
    $req->closeCursor();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>ajout de billet</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<script src="assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet"type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Ajouter un billet de blog</h1>
    <form method="POST" action="#" class="form-group">
     <div class="container">
     	 <label for="titre">Titre</label><br>
	    	<input type="text" name="title" class="form-control" id="titre" placeholder="Entrez le titre du billet"><br><br>

	    	<label for="contenu">Message</label><br>
	    	<textarea cols="5" rows="10" id="contenu" name="contenu" placeholder="Entrez votre Message" class="form-control"></textarea>

    <button type="submit" name="valider" class="btn btn-success btn-lg">Valider</button>
    <a href="index.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span> Menu</a>
     </div>
    </form>
</body>
</html>