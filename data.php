<!DOCTYPE html>
<html>
<head>
	<title>Data</title>
</head>
<body>
<h1>Les données</h1>

<?php
 if(!empty($_POST['nom'] AND $_POST['prenoms'] AND $_POST['sexe'] AND $_POST['jour'] AND $_POST['mois'] AND $_POST['annee'] AND $_POST['pays'] AND $_POST['psuedo'] AND $_POST['email'] AND $_POST['email2'] AND $_POST['mdp'] AND $_POST['mdp2'])){

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
          $mdp = $_POST['mdp']; //sha1() fonction permettant de crypter le mdp
          $mdp2 = sha1($_POST['mdp2']);//sha1()
          

         echo $nom."<br/> ".$prenoms."<br/> ".$sexe."<br/> ".$jour.'/'.$mois.'/'.$annee."<br/>".$pays.'<br/>'.$psuedo.'<br/>'.$email."<br/> ".$mdp;



 }
         

?>

</body>
</html>