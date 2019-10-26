<?php


// check User Input;
function checkInput($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


/*Valider l'email*/
function verifyEmail($var)
{
	return filter_var($var, FILTER_VALIDATE_EMAIL);
}

/*valider le phone*/

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