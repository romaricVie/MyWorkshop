<?php
require('../../bdd.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact-User</title>
	<meta charset="utf-8">
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <script src="assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet"type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <link rel="stylesheet" type="text/css" href="">
</head>
<body>
     <h1><span class="glyphicon glyphicon-user"></span>Contacts des Utilisateurs</h1>

    <table class="table table-striped table-bordered">
    	<thead>
    		<tr>
    			<th>Nom</th>
    			<th>Prenoms</th>
    			<th>Email</th>
    			<th>date</th>
    			<th>fichier</th>
    			<th colspan="2" style="">Actions</th>

    		</tr>
    	</thead>
    	<tbody>
    	<?php
         
         $req = $connexion -> query("SELECT * FROM contacts ORDER BY id DESC");
         $nombre = $req -> rowcount();

         while($donnee = $req ->fetch()){
         ?>

    		<tr>
    			<td><?=$donnee['name']?></td>
    			<td><?=$donnee['firstname']?></td>
    			<td><?=$donnee['email']?></td>
    			<td><?=$donnee['date']?></td>
    			<?php
                 
                echo '<td><a href="../../membres/fichiers/'.$donnee['file'].'">'.$donnee['file'].'</a></td>';
    			echo'<td><a href="message.php?id='.$donnee['id'].'" class="btn btn-success"><span class ="glyphicon glyphicon-eye-open"></span> Voire Message </a></th>';
    			echo'<td><a href="index.php" class="btn btn-primary"><span class ="glyphicon glyphicon-home"></span> Accueil </a></th>';

    			?>
    			
    		
    			
    		</tr>
    	<?php
         }

        $req ->closeCursor();

    	?>
    	</tbody>


    </table>




</body>
</html>