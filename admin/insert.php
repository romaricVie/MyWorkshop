<?php

require 'database.php';
require 'function.php';

// Initialisation des varibles
$nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image ="";

// AU dexième passage après la soumission du formulaire
// Verification des données saisies pas l'utilisateur.
if(!empty($_POST)){

  $name = checkInput($_POST['name']);
  $description = checkInput($_POST['description']);
  $price = checkInput($_POST['price']);
  $category = checkInput($_POST['category']);
  $image = checkInput($_FILES['image']['name']); // Nom image
  $imagPath = '../images/'.basename($image);    // Chemin image
  $imageExtension = pathinfo($imagPath, PATHINFO_EXTENSION); // Extension de l'image.
  $tailleMaxImage = 500000; // Taille maximale de l'image 500KB
  $isSuccess = true;        // Varible de verification...
  $isUploadSuccess = false; // Varible de verifiaction du telechargement de l'image.


  if(empty($name)){
    $nameError =" Ce champs est requis";
    $isSuccess = false;
  }

  if(empty($description)){
   $descriptionError =" Ce champs est requis";
   $isSuccess = false;
  }

  if(empty($price)){
     $priceError =" Ce champs est requis";
     $isSuccess = false;
  }

  if(empty($category)){
     $categoryError =" Ce champs est requis";
     $isSuccess = false;
  }

  if(empty($image)){
     $imageError =" Ce champs est requis";
     $isSuccess = false;
  }else{

    //l'image n'est pas vide, alors on passe au traitement de l'image.
        $isUploadSuccess = true;

        // Verification de l'extension de l'image.
        if($imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif"){
          $imageError ="Le fichier doit etre au fomat .jpeg, .png, .gif";
          $isUploadSuccess = false;
        }

        // Verification de l'unicité de l'image dans le dossier image sur le serveur
        if(file_exists($imagPath)){
          $imageError = "Fichier existe deja";
          $isUploadSuccess = false;
        }

         // Verification de la taille de l'image 
        if($_FILES['image']['size'] > $tailleMaxImage){
           $imageError = "Fichier ne doit pas depase 500KB";
           $isUploadSuccess = false;
        }

        // Verification lors du deplacement de l'image sur le serveur.
        if($isUploadSuccess){
           if(!move_uploaded_file($_FILES['image']['tmp_name'],$imagPath)){
             $imageError = "Erreur pendand l Upload ";
             $isUploadSuccess = false;
           }
        }
        
  }

// Après la verification insertion  dans la BD;
if($isSuccess &&  $isUploadSuccess){
  $db = Database::connect();
  $statement = $db -> prepare("INSERT INTO items(name,description,price,category,image) VALUES(?,?,?,?,?)");
  $statement -> execute(array($name,$description,$price,$category,$image));
  Database::disconnect();
  header('location: index.php');

   }

}

// Au Premier passage affichage du formulaire...
?>


<!DOCTYPE html>
<html>
<head>
	
	<title>burger code</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<script src="assets/jquery/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="icon" type="image/png" href="../images/b2.png">
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger code <span class="glyphicon glyphicon-cutlery"></span></h1>
  <div class="container admin">
  	<div class="row">
  			<h1><strong>Ajouter un item </strong></h1>
  			<br/>
            <form class="form" role="form" action="#" method="POST" enctype="multipart/form-data">
            	<div class="form-group">
              		<label for="name">Nom:</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Nom article" value="<?= $name?>">
                  <span class="help-inline"><?= $nameError ?></span>
            	</div>
            	<div class="form-group">
              		 <label for="description">Description:</label> 
                   <input type="text" name="description" id="description" class="form-control" placeholder="Description  article" value="<?= $description?>">
                   <span class="help-inline"><?= $descriptionError ?></span>
            	</div>
            	<div class="form-group">
            		 <label for="price">Prix: (en €)</label> 
                 <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="Prix  article" value="<?= $price?>">
                <span class="help-inline"><?= $priceError ?></span>
            	</div>
            	<div class="form-group">
            		<label id='category'>Categorie:</label>
                <select id="category" class="form-control" name="category">
                <?php

                 $db = database::connect();
                 // Affiche chaque element de la table categories dans $row

                 foreach ($db -> query("SELECT * FROM categories") AS $row){
                  ?>
                  <option value="<?=$row['id']?>"> <?=$row['name']?> </option>


                  <?php
                 }

                 Database::disconnect();

                ?>
                </select>
               <span class="help-inline"><?= $categoryError ?></span>
            	</div>
            	<div class="form-group">
            	   <label for="image">Selectionner Une image:</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <span class="help-inline"><?= $imageError ?></span>
            	</div>
              <br/>
              <div class="form-actions">
                     <button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-pencil"></span> Ajuter</button>
                     <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retouur</a>
            </div>
          </form>   
  	</div>
  </div>
</body>
</html>