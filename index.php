<?php

require 'admin/database.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>burger code</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<script src="assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="images/b2.png">
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
     <div class="container site">
	     <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger code <span class="glyphicon glyphicon-cutlery"></span></h1>

		     <nav>
		     	  <ul class="nav nav-pills">
		     	  	<?php
                     
                     $db = Database::connect();

                     $statement = $db -> query("SELECT * FROM categories");
                     $categories = $statement -> fetchAll();

                     foreach($categories as $category){
                     	if( $category['id'] == '1')
                     		echo '<li role="presantation" class="active"><a href="#'.$category["id"].'" data-toggle="tab">'.$category["name"].'</a></li>';
                        else
                        	echo '<li role="presantation"><a href="#'.$category["id"].'" data-toggle="tab">'.$category["name"].'</a></li>';
                     	
                     	
                     }
                     	
                     
		     	  	?>
		     	  
		     	  </ul>
		     </nav>
			 
			 <!--Contient tous les elements de la table pane. Tous les articles sont dans la classe "tab-content" -->
	         <div class="tab-content">  
                     <!--Debut tab-pane 1 -->
                   <?php
                    
                     foreach($categories as $category){
                     	if( $category['id'] == '1')
                     		echo '<div class="tab-pane active" id="'.$category["id"].'">';
                        else
                        	echo '<div class="tab-pane" id="'.$category["id"].'">';
                     	
                     echo '<div class="row">';

                   $statement = $db -> prepare("SELECT * FROM items WHERE items.category = ? ");
                   $statement -> execute(array($category['id']));
                   while($item = $statement -> fetch()){
                  
    	   	    
	         	   	    	//<!--1er article de la ligne table-panel 1-->
	         	   	    	 echo  '<div class="col-sm-6 col-md-4">
	         	   	    	   	    <div class="thumbnail">
	         	   	    	   	    	  <img src="images/'.$item["image"].'" alt="...">
	         	   	    	   	    	   <div class="price">'.number_format((float)$item['price'],2,'.', ' ').' €</div>
	         	   	    	   	    	   <div class="caption">
	         	   	    	   	    	   	   <h4>'.$item["name"].'</h4>
	         	   	    	   	    	   	    <p>'.$item["description"].'</p>
	         	   	    	   	    	   	    <a href="#" class="btn btn-order "role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
	         	   	    	   	    	   </div>
	         	   	    	   	    </div>
	         	   	    	  </div>';
                              

                                }

                                echo   '</div> 			   
		                              </div>';

			                   }
			                   Database::disconnect();
                             echo '</div>';   //<!--Fin tab-pane Id 1-->
			                 ?>	
						
						   
			
	               </div> <!--Fin de la table content-->
	        </div>
	      
   </body>
</html>