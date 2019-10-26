<?php

require 'database.php';
require 'function.php';




if(!empty($_GET['id'])){

    $_GET['id'] = checkInput($_GET['id']);
    $_GET['id'] = intval($_GET['id']);
    $id = $_GET['id'];
}


if(!empty($_POST)){

  $id = $_POST['id'];
  $db = Database::connect();
  $statement = $db -> prepare("DELETE FROM items WHERE id = ?");
  $statement -> execute(array($id));
   Database::disconnect();
   header('location: index.php');

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
  			<h1><strong>Supprimer un item </strong></h1>
  			<br/>
            <form class="form" role="form" action="#" method="POST">
            	
             <input type="hidden" name="id" value="<?=$id?>">
             <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
              <div class="form-actions">
                     <button type="submit" class="btn btn-warning" name="submit"><span class=""></span> OUI</button>
                     <a href="index.php" class="btn btn-default"><span class=""></span> NON</a>
            </div>
          </form>   
  	</div>
  </div>
</body>
</html>