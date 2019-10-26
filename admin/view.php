<?php

require 'database.php';
require 'function.php';

// Recuperation de l'id par la methode GET['id'];
if(isset($_GET['id'])){

    $_GET['id'] = checkInput($_GET['id']);
    $_GET['id'] = intval($_GET['id']);
    $id = $_GET['id'];

}


$db = database::connect();
$statement = $db -> prepare("SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category 
                        FROM items LEFT JOIN categories ON items.category = categories.id 
                        WHERE items.id = ?");
$statement -> execute(array($id));
$item = $statement -> fetch();
Database::disconnect();


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
    			<h1><strong>Voir un item </strong></h1>
    			<br/>
              <form>
                  	<div class="form-group">
                  		<label>Nom:</label> <?=$item['name']?>
                  	</div>
                  	<div class="form-group">
                  		<label>Description:</label> <?=$item['description']?>
                  	</div>
                  	<div class="form-group">
                  		<label>Prix:</label> <?=number_format((float)$item['price'],2,'.', ' ')?> €
                  	</div>
                  	<div class="form-group">
                  		<label>Categorie:</label> <?=$item['category']?>
                  	</div>
                  	<div class="form-group">
                  		<label>Image:</label> <?=$item['image']?>
                  	</div>
              </form>
              <br/>
              <div class="form-actions">
                 	<a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retouur</a>
              </div>
  		</div>
	    <div class="col-sm-6 site">
   	    	   	    <div class="thumbnail">
   	    	   	    	  <img src="../images/<?=$item['image']?>" alt="...">
   	    	   	    	   <div class="price"><?=number_format((float)$item['price'],2,'.', ' ')?>€</div>
   	    	   	    	   <div class="caption">
   	    	   	    	   	   <h4><?=$item['name']?></h4>
   	    	   	    	   	    <p><?=$item['description']?></p>
   	    	   	    	   	    <a href="#" class="btn btn-order "role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
   	    	   	    	   </div>
   	    	   	    </div>
   	    	  </div>
  	  </div>
   </div>
</body>
</html>