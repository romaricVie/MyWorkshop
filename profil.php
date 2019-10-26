<?php
session_start();
require('bdd.php');
 


          // Sécurité
          //l'utilisateur accède a la page de profil s'il est a une session sinon connexion 

         //if(isset($_SESSION['id']) AND $userinfos['id'] == $_SESSION['id']){
   

    require("menu.php");

  ?>
  
  
    <div style="text-align: center;">
         
      <h1 style="color: blue;margin-top:70px">Mon Profil</h1>
        <img src="membres/avatars/<?=$_SESSION['avatar'];?>" title="<?=$_SESSION['psuedo'];?>" alt="mon image"class="img-circle" style="width: 100px; height: 100px">
         
        
           <h3><span style="color:blue">Bienvenue</span> <?=$_SESSION['psuedo'];?> </h3>
           <h3><span style="color:green">Vous etre connecté en tant que,</span> <?= $_SESSION['email']; ?></h3>
       
      </div>
             
</body>
</html>
