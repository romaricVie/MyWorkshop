<?php
require('bdd.php');

$temps_session = 30;
// temps unix 1975
$temps_actuel = date("U");
// adresse ip de l'utilisateur 
$user_ip = $_SERVER['REMOTE_ADDR'];
//$user_ip = "19.100.96.17";

$req_ip_exit = $connexion ->prepare("SELECT * FROM online WHERE ip_user = ?");
$req_ip_exit -> execute(array($user_ip));
 // compter le nombre d'enregistrement
$ip_exit = $req_ip_exit -> rowCount();
// si l'ip n'exite pas 
if($ip_exit == 0){
	$add_ip = $connexion -> prepare("INSERT INTO online(ip_user,time) VALUES(?,?)");
	$add_ip -> execute(array($user_ip,$temps_actuel));

}
// sinon faire une mise à jours de la table
else{
	$update_ip = $connexion -> prepare("UPDATE online SET time = ? WHERE ip_user = ?");
	$update_ip ->execute(array($temps_actuel,$user_ip));
}
 // Supprimer le temps de session de l'utilisateur
 $session_delete_time = $temps_actuel - $temps_session;

$del_ip = $connexion ->prepare("DELETE FROM online WHERE time < ? ");
$del_ip -> execute(array($session_delete_time));

// Afficher le nombre d'utilisateur en ligne
$show_user_online_nbr = $connexion -> query("SELECT * FROM online");
$user_nbr = $show_user_online_nbr -> rowCount();






?>

<style type="text/css">
	h1,h2{
		text-align: center;
		font-style: italic;
	}
</style>
   <h1>Nombre d'utilisateur en ligne</h1>
   <h2> Nous avons <strong style="color: green"> <?= $user_nbr?> utilisateur<?php if($user_nbr !=1){ echo "s";}?> en ligne! </strong><h2>
