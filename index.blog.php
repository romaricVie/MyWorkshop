<?php
// Index du blog
session_start();
 require('bdd.php');




 $articlesParPage = 3;

 //Requet pour afficher le nombre total d'article
 $articleTotalsReq = $connexion -> query("SELECT id_billet FROM billets ");
 $articleTotal = $articleTotalsReq -> rowCount();

$pageTotal = ceil($articleTotal / $articlesParPage);

// au deuxieme passage...
if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pageTotal){
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];

}
else{
    $pageCourante = 1;
}

$depart = ($pageCourante - 1) * $articlesParPage;

?>


<?php


   require("menu.php")

?>


<!DOCTYPE html>
<html>
<head>
	<title>mon super Blog</title>
	<meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="assets/bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap-->
    <script src="assets/jquery/jquery-3.3.1.min.js"></script><!-- Jquery-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"><!-- css-->
    <link rel="stylesheet" type="text/css" href="style.blog.css">
	
</head>
<body>
     <h1 style="color: blue; padding-top: 20px">Bienvenue sur mon blog!</h1>
       <!-- <a href="../profil.php?id=<?=$_SESSION['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Mon profil</a>-->

     <p class="infos">les derniers blogs</p>

     <?php
      
      $req = $connexion -> query("SELECT id_billet, titre, contenu, DATE_FORMAT(date_creation,'%d/%m/%Y %Hh%imin%ss') AS date FROM billets ORDER BY date DESC LIMIT ".$depart.",".$articlesParPage
  );

 while ($donnee = $req -> fetch()) {
     ?>
     <div class="news">
     	  <h3><?= $donnee['titre']; ?>
     	       <em>le <?= $donnee['date'] ?></em>
     	  </h3>
     	<p>
     		<?= nl2br($donnee['contenu'])?>
     	
         <br/>
             <em><a href="commentaire.php?billet=<?=$donnee['id_billet'];?>">Commentaire </a></em>
         </p>
     </div>
 <?php	
 }
 $req ->closeCursor();

for($i = 1 ; $i <= $pageTotal; $i++){
    if($i == $pageCourante){
        echo "<span class='btn btn-danger'>".$i."</span>";
    }
    else{

        echo "<a href=index.blog.php?page=".$i."><span class='btn btn-success'>".$i."</span></a>";
    }
    
}


 ?>

</body>
</html>