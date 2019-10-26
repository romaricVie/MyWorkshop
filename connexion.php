<?php
session_start();
// Page de connexion
require('bdd.php');
require('function.php');

if(isset($_POST['submit'])){

     if(!empty($_POST['emailconnecte']) AND !empty($_POST['mdpconnecte'])){
          $emailconnecte = InputUser($_POST['emailconnecte']);
          $mdpconnecte = sha1($_POST['mdpconnecte']); //sha1()

        $requser = $connexion -> prepare("SELECT * FROM membres WHERE email = ? AND motdepasse = ? ");
         $requser -> execute(array($emailconnecte, $mdpconnecte));
         
         // verification des données dans la bdd
         $userexiste = $requser -> rowCount();
         // Securité vraiment génial
         if($userexiste == 1){
          $userinfos = $requser -> fetch();
          $_SESSION['id'] =  $userinfos['id'];
          $_SESSION['psuedo'] = $userinfos['psuedo'];
          $_SESSION['email'] = $userinfos['email'];
          $_SESSION['avatar'] = $userinfos['avatar'];
          header("location:profil.php?id=".$_SESSION['id']);
           
         }
         else
         {
          $erreur = "Mauvais mail ou Mot de passe!";
         }
      
     }
     else
     {
       $erreur = "Les champs sont réquis!";
     }

   }

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>connexion</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <script src="assets/jquery/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.contact.css">
</head>
<body>
   <form action="" method="POST">
       <fieldset style="text-align: center;" class="container">
        
          <h1>CONNEXION</h1>
          <div class="row">
              
            
            <div class="col-md-6">
                <label for="email">Email</label><br>
                <input type="email" id="email" name="emailconnecte" placeholder="Entrez votre email" class="form-control"><br><br>
            </div>
           
            <div class="col-md-6">
                  <label for="password">Mot de Passe</label><br>
                  <input type="password" id="password" name="mdpconnecte" placeholder="Entrez votre Mot de Passe" class="form-control"><br><br>
            </div>
            <div class="col-md-6">
               <button type="submit" name="submit"class="btn btn-success"><span class='glyphicon glyphicon-log-in'> Connexion</button>
            </div>
           <div class="col-md-6">
              <?php
            if(isset($erreur)){
              echo "<span class='alert alert-danger'>".$erreur."</span>";
            }

           ?>
           </div>
          
        </div>
       </fieldset>
   </form>
</body>
</html>