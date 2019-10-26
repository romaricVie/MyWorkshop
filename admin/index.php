<?php

require 'database.php';

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
  		<h1><strong>Liste des items </strong><a href="insert.php"class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
      <table class="table table-striped table-bordered">
        <thead>
              <tr>
                 <th>Nom</th>
                 <th>Description</th>
                 <th>Prix</th>
                 <th>Categorie</th>
                 <th>Action</th>
              </tr>
        </thead>
        <tbody>
            
                <?php
                 
                 $db = Database::connect();
                 $statement = $db -> query("SELECT items.id, items.name, items.description, items.price, categories.name AS category 
                        FROM items LEFT JOIN categories ON items.category = categories.id 
                        ORDER BY items.id DESC");
                 while($item = $statement -> fetch()){
                  ?>
              <tr>
                  <td><?=$item['name']?></td>
                  <td><?=$item['description']?></td>
                  <td><?=number_format((float)$item['price'],2,'.', ' ')?></td>
                  <td><?=$item['category']?></td>
                  <td width = 300px>
                      <a href="view.php?id=<?=$item['id']?>" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>
                      <a href="update.php?id=<?=$item['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>
                      <a href="delete.php?id=<?=$item['id']?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>
                  </td>
            </tr>

             <?php

                  }

                 Database::disconnect();

             ?>
        </tbody>
      </table>
  		
  	</div>
  </div>

   
</body>
</html>