<?php

// verification des données de l'user
function InputUser($var){
	$var = trim($var);
	$var = stripslashes($var);
	$var = htmlspecialchars($var);
	return $var;
}

/*Valider l'email*/
function verifyEmail($var)
{
	return filter_var($var, FILTER_VALIDATE_EMAIL);
}

/*valider le numéro de phone*/

function verifyPhone($var)
{
	return preg_match("/^[0-9 ]*$/", $var);
}


// $var = "BONJOUR.PDF";
 // Function permerttant de retourner l'extension d'un fichier en miniscule;


function extension($var){
	return strtolower(substr(strrchr($var, '.'), 1));
}

?>



