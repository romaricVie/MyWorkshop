<?php 
   // Connection a la bdd

	require('bdd.php');

  // Vérifie si l'utilisaeur a soumit le formalaire 
  
 if(isset($_POST['submit'])){

     // Vérifie si les champs ne sont pas vide
     if(!empty($_POST['nom'] AND $_POST['prenoms'] AND $_POST['sexe'] AND $_POST['jour'] AND $_POST['mois'] AND $_POST['annee'] AND $_POST['pays'] AND $_POST['psuedo'] AND $_POST['email'] AND $_POST['email2'] AND $_POST['mdp'] AND $_POST['mdp2'])){
          
          //Récupération des variable name par la methode POST
          $nom = htmlspecialchars($_POST['nom']);
          $prenoms = htmlspecialchars($_POST['prenoms']);
          $sexe = htmlspecialchars($_POST['sexe']);
          $jour = htmlspecialchars($_POST['jour']);
          $mois = htmlspecialchars($_POST['mois']);
          $annee = htmlspecialchars($_POST['annee']);
          $pays = htmlspecialchars($_POST['pays']);
          $psuedo = htmlspecialchars($_POST['psuedo']);
          $email  = htmlspecialchars($_POST['email']);
          $email2 = htmlspecialchars($_POST['email2']);
          $mdp = sha1($_POST['mdp']); //sha1() fonction permettant de crypter le mdp
          $mdp2 = sha1($_POST['mdp2']);//sha1()
          
         
        

        //Vérification de la taille du spuedo
          $psuedolength = strlen($psuedo) ;


          if($psuedolength <= 255) {

            // Vérification de la correspondance des mails
            // 
             if($email == $email2){
                //Vérification de l'unicité du mail dans la BD

                $reqemail = $connexion -> prepare("SELECT * FROM membres WHERE email = ?");
                $reqemail -> execute(array($email));
                $emailexist = $reqemail -> rowCount();
                //permettant d'eviter les doublons
                if($emailexist == 0){
                   
                  // Vérification de la correspondance des  mots de passe.
                 if($mdp == $mdp2){
                //Vérification de l'unicité du mail dans la BD
                $reqmdp = $connexion -> prepare("SELECT * FROM membres WHERE motdepasse = ?");
                $reqmdp -> execute(array($mdp));
                $mdpexist = $reqmdp -> rowCount();
                    if($mdpexist == 0) {

                          // Toutes les conditions sont respectées
                          // Insertion dans la BD
                         //Connexion à la page du profil
                         /*
                          $req = $connexion ->prepare("INSERT INTO membres(nom,prenoms,sexe,jour,mois,annee,pays,psuedo, email, motdepasse,avatar) VALUES(?,?,?,?,?,?,?,?,?,?,'default.png')");
                          $rep = $req -> execute(array($nom,$prenoms,$sexe,$jour,$mois,$annee,$pays,$psuedo,$email,$mdp));
                          echo "<p class='alert alert-success'>Votre compte a été créé avec Succès!<P> 
                          <a href='connexion.php' class='btn btn-success'>Se connecter</a>";
                        */
                           $avatar ='default.png';
                           $req = $connexion ->prepare("INSERT INTO membres(nom,prenoms,sexe,jour,mois,annee,pays,psuedo, email, motdepasse,avatar) VALUES(:nom,:prenoms,:sexe,:jour,:mois,:annee,:pays,:psuedo,:email,:motdepasse,:avatar)");
                          $rep = $req -> execute(array(
                            "nom" => $nom,
                            "prenoms" => $prenoms,
                            "sexe" => $sexe,
                            "jour" => $jour,
                            "mois" => $mois,
                            "annee" => $annee,
                            "pays" => $pays,
                            "psuedo" => $psuedo,
                            "email" => $email,
                            "motdepasse" => $mdp,
                            "avatar" => $avatar
                          ));
                          echo "<p class='alert alert-success'>Votre compte a été créé avec Succès!<P> 
                          <a href='connexion.php' class='btn btn-success'>Se connecter</a>";
             
                          $req ->closeCursor();

                    

                 }
                 else
                     {
                         $erreur = "mot de passe déja utiliser!";
                     }
                 }
                 else
                    {
                      $erreur = "Vos mots de passe ne correspondent pas!";
                    }

                  }

               else
                     {
                       $erreur = "Adresse email déja utiliser!";
                     }
                
              }

             else
                  {
                      $erreur = "Vos adresses email ne correspondent pas!";
                  }

            }
          else
              {
                 $erreur = "votre psuedo ne doit pas dépasser 255 caractères";
              }

         }
     else
         {
           $erreur = "Tous les Champs sont réquis!!!";
         }
   }
   

?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>register</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <script src="assets/jquery/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
   <form action="#" method="POST">
   	 <fieldset style="text-align: center;" class="container">
   	 	 <h1>INSCRIPTION</h1>
       <div class="row">

        <div class="col-md-6">
            <label for="nom">Nom</label><br>
            <input type="text" id="nom" name="nom" placeholder="Entrez votre Nom" maxlength="30" class="form-control"value="<?php if(isset($nom)){ echo $nom;}?>"><span></span><br><br>
        </div>

        <div class="col-md-6">
            <label for="prenoms">Prenoms</label><br>
            <input type="text" id="prenoms" name="prenoms" placeholder="Entrez votre prenoms" maxlength="30" class="form-control"value="<?php if(isset($prenoms)){ echo $prenoms;}?>"><span></span><br><br>
        </div>

        <div class="col-md-6">
            <label for="sexe">Sexe</label><br>
            <input type="radio" name="sexe" id="sexe" value="Homme">homme<br/>
            <input type="radio" name="sexe" id="sexe" value="Femme">femme<br/>
            
        </div>

        <div class="col-md-6">
            <label for="">Date de Naissance</label><br/>
            <label for="jour">Jour</label>
            <input type="number" name="jour" id="jour" min="01" max="31" class="">

            <label for="mois">Mois</label>
            <input type="number" name="mois" id="mois" min="01" max="12" class="">

            <label for="annee">Année</label>
            <input type="number" name="annee" id="annee" min="1940" max="2020" class=""><br/><br/><br/>

        </div>

        <div class="col-md-6">
            <label for="pays">Pays de résidence</label><br>
            <select name="pays" id="pays" class="form-control">
                <option value="" type="" id="">Choisir...</option>
                <option type="select"  value="Cote d'ivoire">Cote d'ivoire </option>
                <option type="select"  value="France">France </option>
                <option type="select"  value="Etats_Unis">Etats_Unis </option>
                <option type="select"  value="Israel">Israel </option>
                <option type="select"  value="Rwanda">Rwanda </option>
                <option type="select"  value="Ethiopie">Ethiopie </option>
                <option type="select"  value="Portugal">Portugal </option>
                <option type="select"  value="Allemangne">Allemangne </option>
                <option type="select"  value="Russie">Russie </option>
                <option type="select"  value="Italie">Italie </option>
                <option type="select"  value="Espagne">Espagne </option>
                <option type="select"  value="Senegal">Senegal </option>
         </select>
            
      </div>



         <div class="col-md-6">
            <label for="psuedo">Psuedo</label><br>
            <input type="text" id="psuedo" name="psuedo" placeholder="Entrez votre psuedo" maxlength="20" class="form-control"     value="<?php if(isset($psuedo)){ echo $psuedo;}?>"><br><br>
        </div>
        <div class="col-md-6">
           <label for="email">email</label><br>
            <input type="email" id="email" name="email" placeholder="Entrez votre email" class="form-control" value="<?php if(isset($email)){ echo $email;}?>"><br><br>
        </div>
   	 	  <div class="col-md-6"> 
           <label for="email2">Email Confirm</label><br>
           <input type="email" name="email2" id="email2" placeholder="Confirm email" class="form-control" value="<?php if(isset($email2)){ echo $email2;}?>"><br><br>
        </div>
        <div class="col-md-6">
           <label for="mdp">Mot de Passe</label><br>
           <input type="password" name="mdp" id="mdp" placeholder="Entrez votre Mot de Passe" class="form-control"><br><br>
        </div>
        <div class="col-md-6">
           <label for="mdp2">Confirmer le mot de passe</label><br>
           <input type="password" name="mdp2" id="mdp2" placeholder="Mot de Passe Confirm" class="form-control" ><br><br>
        </div>
   	 	  <div class="col-md-6">
           <input type="submit" name="submit" value="valider" class="btn btn-success">
        </div>

        
    </div>
      <?php
    if(isset($erreur)){
              echo "<p class='alert alert-danger'>".$erreur."</p>";
         }
    ?>
   	 </fieldset>
   </form>
</body>
</html>