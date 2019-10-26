<?php

require 'database.php';
require 'function.php';

$nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image ="";

// Recuperation de l'identifiant de l'arcle.
// Verfication de securité 
if(!empty($_GET['id'])){

    $_GET['id'] = checkInput($_GET['id']);
    $_GET['id'] = intval($_GET['id']);
    $id = $_GET['id'];

}


//Deuxieme passage après la soumission du formulaire...
if(!empty($_POST)){

  $name = checkInput($_POST['name']);
  $description = checkInput($_POST['description']);
  $price = checkInput($_POST['price']);
  $category = checkInput($_POST['category']);
  $image = checkInput($_FILES['image']['name']); // Nom image
  $imagPath = '../images/'.basename($image);    // Chemin image
  $imageExtension = pathinfo($imagPath, PATHINFO_EXTENSION); // Extension image
  $tailleMaxImage = 500000; // Taille maximale de l'image 500KB
  $isSuccess = true;       // Variable de verification 
 


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
    $imageError = "Ce champs est requis";
    $isImageUpdated = false;

  }else{
    //l'image n'est pas vide
         $isImageUpdated = true;
         $isUploadSuccess = true;
        if($imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif"){
          $imageError ="Le fichier doit etre au fomat .jpeg, .png, .gif";
          $isUploadSuccess = false;
        }
        // si le fichier existe
        if(file_exists($imagPath)){
          $imageError = "Fichier existe deja";
          $isUploadSuccess = false;
        }
         // la taille du fichier
        if($_FILES['image']['size'] > $tailleMaxImage){
           $imageError = "Fichier ne doit pas depases 500KB";
           $isUploadSuccess = false;
        }
        // deplace l'image sur le serveur.
        if($isUploadSuccess){
           if(!move_uploaded_file($_FILES['image']['tmp_name'],$imagPath)){
             $imageError = "Erreur pendand l Upload ";
             $isUploadSuccess = false;
           }
        }
        
  }

// abscence d'erreur insertion dans la bd;
if(($isSuccess && $isImageUpdated  && $isUploadSuccess) || ($isSuccess && !$isImageUpdated)){
  $db = Database::connect();
  if($isImageUpdated){

    // Mise à jour de l'image
      $statement = $db -> prepare("UPDATE items SET name = ?, description = ?, price = ?, category = ?, image = ? WHERE id = ?");
      $statement -> execute(array($name,$description,$price,$category,$image ,$id));
  }else{
    // L'image n'a pas éte modifier.
      $statement = $db -> prepare("UPDATE items SET name = ?, description = ?, price = ?, category = ? WHERE id = ?");
      $statement -> execute(array($name,$description,$price,$category,$id));
  }
  Database::disconnect();
  header('location: index.php');

}else if($isImageUpdated && !$isUploadSuccess){
  $db = Database::connect();
  $statement = $db -> prepare("SELECT image FROM  items WHERE id = ?");
  $statement -> execute(array($id));
  $item =  $statement -> fetch();
  $image = $item['image'];

  Database::disconnect();

}

}else{
 
// Au premier passage;
// Requete pour Afficher les donnée de l'article dont l'ID est dans la methode GET['id'];
  $db = Database::connect();
  $statement = $db -> prepare("SELECT * FROM  items WHERE id = ?");
  $statement -> execute(array($id));

  $item =  $statement -> fetch();
  // stockage des données dans les variables
  $name = $item['name'];
  $description = $item['description'];
  $price = $item['price'];
  $category = $item['category'];
  $image = $item['image'];

  Database::disconnect();


}





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
      <div class="col-sm-6">
         <h1><strong>Modifier un item </strong></h1>
          <br/>

            <form class="form" role="form" action="update.php?id=<?=$id?>" method="POST" enctype="multipart/form-data">
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
                           // Req permettant d'afficher tous les contenus de table Categorie dans la varible $row
                            foreach ($db -> query("SELECT * FROM categories") AS $row){
                              if($row['id'] == $category){
                                    echo '<option selected="selected" value="'.$row["id"].'">'.$row["name"].'</option>';
                                }else{
                                     echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                 }
                    
                               }

                          Database::disconnect();

                      ?>
                    </select>
                     <span class="help-inline"><?= $categoryError ?></span>
                  </div>
                  <div class="form-group">
                          <label>Image:</label>
                          <p><?=$image?></p>
                          <label for="image">Selectionner Une image:</label>
                          <input type="file" name="image" id="image" class="form-control">
                          <span class="help-inline"><?= $imageError ?></span>
                  </div>
                  <br/>
                  <div class="form-actions">
                         <button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                         <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retouur</a>
                </div>
            </div>
          </form>
      
      <div class="col-sm-6 site">
                <div class="thumbnail">
                      <img src="../images/<?=$image?>" alt="...">
                       <div class="price"><?=number_format((float)$price,2,'.', ' ')?>€</div>
                       <div class="caption">
                            <h4><?=$name?></h4>
                            <p><?=$description?></p>
                            <a href="#" class="btn btn-order "role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
                       </div>
                  </div>
              </div>  
  	 </div>
  </div>
</body>
</html>