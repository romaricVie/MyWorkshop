<?php
session_start();
require('function.php');
require('bdd.php');

if(isset($_SESSION['id'])){
  $requser = $connexion->prepare("SELECT * FROM membres WHERE id = ?");
  $requser -> execute(array($_SESSION['id']));
  $user = $requser -> fetch();

// verification des contenus de la variable poste
if(isset($_POST['update'])){

   if(!empty($_POST['newspsuedo']) AND !empty($_POST['newemail']) AND !empty($_POST['newmdp1']) AND !empty($_POST['newmdp2'])){

  $newspsuedo = InputUser($_POST['newspsuedo']);
  $newemail = InputUser($_POST['newemail']);
  $newmdp1 = sha1($_POST['newmdp1']);      // sha1()
  $newmdp2 = sha1($_POST['newmdp2']);// sha1()
  
  // Mise à jour des donnees dans la bdd

 // verification du mot de passe
  if($newmdp1 == $newmdp2){
    
      // Traitement d'image de profil.
      if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
       // taille maximum de l'image
        $tailleMax = 2097152;
        // extensions possibles
        $extensionValides = array('jpg','jpeg','gif','png');
        if($_FILES['avatar']['size'] <= $tailleMax){
          // conversion en minuscule de l'extension
          $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
           // verifie si l'extension téléchargée est dans le tableau extensionValides
           if(in_array($extensionUpload, $extensionValides)){
             // creer un chemin vers le serveur
             $chemin = "membres/avatars/".$_SESSION['id'].".".$extensionUpload;
             // déplacer l'image sur le serveur
             $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
             if($resultat){
             
                    $requser = $connexion -> prepare("UPDATE membres SET psuedo = :newspsuedo, email = :newemail, motdepasse = :newmdp1, avatar =:avatar 
                      WHERE id = :id");
                    $requser -> execute(array(

                    'newspsuedo' => $newspsuedo,
                    'newemail'  => $newemail,
                     'newmdp1' => $newmdp1,
                     'avatar' => $_SESSION['id'].".".$extensionUpload,
                      'id' => $_SESSION['id']
                  ));

                  echo "<p class='alert alert-success'>Mise à jour effectuée avec succès!!!</p>";
                  echo "<a href='connexion.php' class='btn btn-warning'>Se reconnecter</a>";


             }
             else{
              $error ="erreur pendant l'importation de votre fichier.";
             }

           }
           else{
            $error = "Format d'image invalide";
           }

        }
        else{
          $error ="Votre photo ne doit pas depasser 2MO";
        }
      }
          
      }
else{
    $error="les mots de passe sont diffents!!!";
  }

}
else{
  $error="Tous les champs sont réquis!!!";
 }
}

 
?>
<!DOCTYPE html>
<html>
<head>
  <title>update</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <script src="assets/jquery/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.contact.css">
</head>
<body>
      <div style="text-align: center;">

         <h1 style="color: blue">Mise a jour du profil</h1>
         <h2 class="alert alert-warning">Après la mise à jour vous serez deconnecté, ensuite veuillez vous reconnectez </h2>
         <?php  
           if(isset($error)){
             echo "<p class='alert alert-danger'>".$error."</p>";
           }
         ?>

         <form method="POST" action="#" enctype="multipart/form-data">
          <fieldset>
            <div class="row">
            <div class="col-md-6">
              <label for="newspsuedo" >psuedo</label><br>
              <input id="newspsuedo"type="text" name="newspsuedo"value="<?=$user['psuedo'];?>" placeholder="" class="form-control"><br>
            </div>
             <div class="col-md-6">
                <label for="mail" >mail</label><br>
                <input id="mail"type="mail" name="newemail"value="<?=$user['email'];?>" placeholder="" class="form-control"><br>
             </div>
             <div class="col-md-6">
               <label for="password" >mot de passe</label><br>
               <input id="password"type="password" name="newmdp1" placeholder="mot de passe" class="form-control"><br><br>
             </div>
             <div class="col-md-6">
               <label for="password1">confirme mot de passe</label><br>
               <input id="password1"type="password" name="newmdp2"placeholder="confirme mot de passe" class="form-control"><br><br>
            </div>
            
           <div class="col-md-6">
              <label for="avatar">photo</label>
              <input type="file" id="avatar" name="avatar"class="form-control" ><br><br>
           </div>
           <div class="col-md-6">
               <input type="submit" name="update" value="Mettre à jour mon profil" class="btn btn-primary"><br><br>
            </div>
            <div class="col-md-6">
               <?php
                   echo "<a href='profil.php?id=".$_SESSION['id']."' class='btn btn-success'>Retour au Profil</a>";
               ?>
              </div>
              </div>
            </fieldset>
          </form>
      </div>     
</body>
</html>
<?php
 
}

else{
  header("location:connexion.php");
}

$requser ->closeCursor();

?>

