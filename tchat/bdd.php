<?php
   $dbHost = "127.0.0.1";
    $dbName = "workshop";
    $dbUser = "root";
    $dbcharset="utf8";
    $dbUserPassword = "";
     
  try
  {
   $connexion = new PDO("mysql:host=".$dbHost.";dbname=".$dbName.";charset=".$dbcharset,$dbUser,$dbUserPassword);
   $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e)
  {
    die($e->getMessage());
  }
  
  ?>

