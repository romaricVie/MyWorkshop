<?php
 // Page de contact
 require('function.php');
 require('bdd.php');

 // echo strtolower(substr(strrchr($var, '.'), 1))."<br>";


  if(isset($_POST['contact'])){
    if(!empty($_POST['name'] AND $_POST['firstname'] AND $_POST['email'] AND $_POST['message'] AND $_POST['tel'])){
      
      $name = InputUser($_POST['name']);
      $firstname = InputUser($_POST['firstname']);
      $email = InputUser($_POST['email']);
      $message = InputUser($_POST['message']);
      $tel = InputUser($_POST['tel']);
      
      // verification de sécurité 
       if(verifyPhone($tel)){
          if(verifyEmail($email)){
              
               

      if(isset($_FILES['file']) AND !empty($_FILES['file']['name'])){
         
         $tailleMax_fichier =  2097152;
         $extension_valide = array('pdf','txt');
        if($_FILES['file']['size'] <= $tailleMax_fichier){

           $extensionUpload = strtolower(substr(strrchr($_FILES['file']['name'], '.'), 1));
           if(in_array($extensionUpload, $extension_valide)){

             $chemin = "membres/fichiers/".$_FILES['file']['name'];
             $resultat = move_uploaded_file($_FILES['file']['tmp_name'], $chemin);
             if($resultat){

               $req = $connexion -> prepare("INSERT INTO contacts(name,firstname,email,message,phone,file) VALUES(?,?,?,?,?,?)");

              $req -> execute(array($name,$firstname,$email,$message,$tel,$_FILES['file']['name']));
               $req -> closeCursor();
              echo "<p class='alert alert-success'>Message bien réçu! Merci de nous avoir contacter... </p>";
              echo "<a href='index.php'class='btn btn-success'>Acceuil </a>";
              
              
             }else{
              $erreur ="erreur de téléchagement...";
             }

           

           }else{
           $erreur = "le fichier doit etre au format pdf ou txt";
           }

        }else{
          $erreur ="La taille du fichier doit etre inferieure à 2MO";
        }



       }else{

           $req = $connexion -> prepare("INSERT INTO contacts(name,firstname,email,message,phone) VALUES(?,?,?,?,?)");

            $req -> execute(array($name,$firstname,$email,$message,$tel));
             $req -> closeCursor();

              echo "<p class='alert alert-success'> Message bien réçu! Merci de nous avoir contacter... </p>";
              echo "<a href='index.php'class='btn btn-success'>Acceuil </a>";

          }

        }else{
             $erreur = "email invalide";
          }

       }else{
          $erreur ="numero invalide";
       }
      
     
    }
    else{
      header('location: contact.php');
    }
    
   
  } 
  
      

?>


<!DOCTYPE html>
<html>
<head>
	<title>Contact</title>
	<meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="assets/bootstrap/js/bootstrap.min.js"></script><!--Bootstrap-->
    <script src="assets/jquery/jquery-3.3.1.min.js"></script><!--Jquery-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"><!--css-->
    <link rel="stylesheet" type="text/css" href="style.contact.css">
</head>
<body>
  <form action="" method="POST" class="form-group" enctype="multipart/form-data">
  	 <h1>Nous contacter maintenant!</h1>
  	<fieldset style="text-align: center;" class="container">
      <?php
      
      if(isset($erreur)){
        echo "<p class='alert alert-danger'>".$erreur."</p>";
      }
     
      ?>
      <div class="rows">
        <div class="col-md-6">
             <label for="name">Nom <span class="red"> *</span></label>
             <input type="text" name="name" id="name" class="form-control" placeholder="Entrer votre nom"><br><br>
         </div>
         <div class="col-md-6">
             <label for="firstname">Prenoms <span class="red"> *</span></label>
             <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Entrer votre nom"><br><br>
          </div>
          <div class="col-md-6">
              <label for="tel">Téléphone <span class="red"> *</span></label>
              <input type="tel" name="tel" id="tel" class="form-control" placeholder="Entrer votre numero de Téléphone"><br><br>
          </div>
          <div class="col-md-6">
              <label for="email">E-mail <span class="red"> *</span></label>
              <input type="emailll" name="email" id="email" class="form-control" placeholder="Entrer votre e-mail"><br><br>
          </div>
          <div class="col-md-6">
              <label for="message">Message<span class="red"> *</span></label>
              <textarea type="text" rows="10" cols="12" name="message" id="message" class="form-control" placeholder="Entrer votre message"></textarea><br><br>
          </div>
          <div class="col-md-6">
             <label for="file">Ajouter un fichier au format PDF</label>
             <input type="file" name="file" id="file" class="form-control"><br><br>
          </div>
          <div class="col-md-6">
               <input type="submit" name="contact" class="btn btn-primary btn-md"><br><br>
          </div>
          <label class="red">Champs réquis * </label><br><br>
         
      </div>
     
  	</fieldset>
  	
  </form>
</body>
</html>