<?php
require('../../bdd.php');

?>

<!DOCTYPE html>
<html>
<head>
	    <title>Supprimer</title>
	    <meta charset="utf-8">
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<script src="assets/jquery/jquery-3.3.1.min.js"></script>
	    <link rel="stylesheet"type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
	    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
  <h1>Supprimer message</h1>

  <form method="POST" action="#">
	      <div class="container">
                      <div class="thumbnail">
                      	 <p>Voulez-vous supprimer le message?</p>
		         	   	    	<a href="contact.php" class="btn btn-primary "role="button"><span class=""></span>Annuler</a>
		         	   	    	   <button type="submit" name="yes" class="btn btn-danger">
		         	   	    	   	      <span class="glyphicon glyphicon-remove"></span> Supprimer</a>
		         	   	    	   	</button>
		         	   	 </div>
	         	   	           
             </div>	         	   	    	
 </form>

  <?php
   
   if(isset($_GET['id'])){

   	$_GET['id'] = intval($_GET['id']);
   	
      if(isset($_POST['yes'])){

     		       $req = $connexion -> prepare("DELETE FROM contacts WHERE id = ?");
				   $req -> execute(array($_GET['id']));

				   	echo "<p class='alert alert-success'>message supprimé avec succèss<p>";
				   	echo  '<a href="contact.php" class="btn btn-primary"> Page des Contacts</a>';

				   	 $req->closeCursor();
          }
   
   }

   

  ?>


</body>
</html>