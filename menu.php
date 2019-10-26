<?php

// Menu

require('bdd.php');
 

if(isset($_GET['id']) AND $_GET['id'] > 0) {

  $getid = intval($_GET['id']);
  
  $req = $connexion->prepare("SELECT * FROM membres WHERE id = ?");
  $req -> execute(array($getid));

   $userinfos = $req->fetch();
  
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.menu.css">
</head>
<body>
     <header>
            <nav class="navbar navbar-inverse navbar-fixed-top">
            
              <div class="container-fluid" >
                  <div class="navbar navbar-header">
                     <button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#monMenu">
                        <span class="icon-bar"></span>
                        <!--Menu responsive 3 barre icons-->
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                  
                        <a href="#" class="navbar-brand">MyWorkshop</a>
                  </div>
                  <!--Menu responsive ouverture du menu a partir des 3 barres icons-->
                    <div class="collapse navbar-collapse" id="monMenu">
                      <ul class="nav navbar-nav">
                          <li><a href="accueil.php"><span class='glyphicon glyphicon-home'></span> Accueil</a></li>
                          <li><a href="index.blog.php?id=<?=$_SESSION['id']?>"><span class='glyphicon glyphicon-book'></span> Blog</a></li>
                           <li><a href="tchat.php?id=<?=$_SESSION['id']?>"><span class='glyphicon glyphicon-comment'></span> Tchat</a></li>
                          <li><a href="profil.php?id=<?=$_SESSION['id']?>"><span class='glyphicon glyphicon-user'></span> Profil</a></li>
                          <li><a href="contact.php"><span class='glyphicon glyphicon-phone'></span>Nous Contacter</a></li>
                          <li><a href="equipe.php"><span class='glyphicon glyphicon-infos'></span>Qui Sommes Nous?</a></li>
                      </ul>
                        <ul class="nav navbar-nav navbar-right">
                           <li style="padding:10px"><img src="membres/avatars/<?=$_SESSION['avatar'];?>" title="<?=$_SESSION['psuedo'];?>" alt="Image"class="img-circle" style="width:50px; height:50px"></li>
                        
                           <!--
                           <li><a href="deconnection.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li> -->
                  <li style="padding:15px">
                    <div class="dropdown">
                         <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button><!--le bouton qui ouvre la liste-->

                           <ul class="dropdown-menu">
                                 <li class="dropdown-header">Menu</li>
                                 <li><a href="update.php"><span class='glyphicon glyphicon-pencil'></span> Editer mon profil</a></li>
                                 <li><a href="delete.php"><span class='glyphicon glyphicon-remove'></span> Supprimer mon Compte</a></li>
                                 <li><a href="deconnection.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
                            </ul>
                       </div>
                   </li>
                </ul>        
            </div> 
          </div>
        </nav>
     </header>
</body>
</html>