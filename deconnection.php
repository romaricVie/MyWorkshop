<?php
 // Page tunelle
// page permettant de se deconneter.
session_start();
$_SESSION = array();
session_destroy();
header("location:index.php");

?>