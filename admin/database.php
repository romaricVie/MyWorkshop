
<?php
        /*  Connection a la base de donnée*/
    class Database
	 {
	 	/*Propriétés */
		 private static $dbHost = "localhost";
		 private static $dbName = "burger_code";
		 private static $dbUser = "root";
		 private static $dbcharset="utf8";
		 private static $dbUserPassword = "";
		 
		 private static $connection=null;
		 
		 /*Methodes*/

		 public static function connect()
		 {
			  try
				{
					self::$connection = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName.";charset=".self::$dbcharset,self::$dbUser,self::$dbUserPassword);
					self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}
				catch(PDOException $e)
				{
					die($e->getMessage());
				} 
				return self::$connection;
		 }
		 
		  public static function disconnect()
		  {
			  self::$connection = null;
		  }

		  
       
	 }
	 
    
?>


