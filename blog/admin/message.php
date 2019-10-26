<?php
require('../../bdd.php');

?>


<!DOCTYPE html>
<html>
<head>
		<title>message-User</title>
		<meta charset="utf-8">
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<script src="assets/jquery/jquery-3.3.1.min.js"></script>
	    <link rel="stylesheet"type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
	    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
       <h2>Message</h2>
       <?php

        if(isset($_GET['id'])){
        	$_GET['id'] = intval($_GET['id']);
        	$id = $_GET['id'];
        	
        	$req = $connexion -> prepare("SELECT id,name,email,message, DATE_FORMAT(date,'%d/%m/%Y %Hh%imin%ss') AS date FROM contacts
        		WHERE id = ?");
        	$req ->execute(array($id));

        	$donnee = $req -> fetch();
        	?>
            
         <div class="news">
        <h3><?= $donnee['name']; ?>
             <em>le <?= $donnee['date'] ?></em>
        </h3>
      <p>
        <?= nl2br($donnee['message'])?>
      
         <br/>
           mail:  <?= $donnee['email'] ?></br></br>
            <a href="contact.php"class="btn btn-primary" role="button"><span class="glyphicon glyphicon-phone"></span>Contacts</a>
           <a href="delete.user.message.php?id=<?=$donnee['id']?>"class="btn btn-danger "role="button"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>

         </p>
     </div>






       <?php
        }

        $req ->closeCursor();
       ?>
</body>
</html>