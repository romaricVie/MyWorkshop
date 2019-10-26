<?php
require('bdd.php');

$temps_session = 1000;
// temps unix 1975
$temps_actuel = date("U");
// adresse ip de l'utilisateur 
$user_ip = $_SERVER['REMOTE_ADDR'];
//$user_ip = "19.100.96.17";

$req_ip_exit = $connexion ->prepare("SELECT * FROM membres WHERE ip_user = ?");
$req_ip_exit -> execute(array($user_ip));
 // compter le nombre d'enregistrement
$ip_exit = $req_ip_exit -> rowCount();
// si l'ip n'exite pas 
if($ip_exit == 0){
	$add_ip = $connexion -> prepare("INSERT INTO membres(ip_user,time) VALUES(?,?)");
	$add_ip -> execute(array($user_ip,$temps_actuel));

}
// sinon faire une mise à jours de la table
else{
	$update_ip = $connexion -> prepare("UPDATE membres SET time = ? WHERE ip_user = ?");
	$update_ip ->execute(array($temps_actuel,$user_ip));
}
 // Supprimer le temps de session de l'utilisateur
 $session_delete_time = $temps_actuel - $temps_session;

$del_ip = $connexion ->prepare("DELETE FROM membres WHERE time < ? ");
$del_ip -> execute(array($session_delete_time));

?>