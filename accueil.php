<!--Page accuel-->


<!DOCTYPE html>
<html>
<head>
	<title>accueil</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="">
</head>
<body>
     <h1>Les Domaines de Compétence et les projets Réalisés</h1>
     <div id="monCarousel" class="carousel slide" data-ride="carousel" style="">
							 <ol class="carousel-indicators">
									<li data-target="#monCarousel" data-slide-to="0" class="active"></li>
									<li data-target="#monCarousel" data-slide-to="1"></li>
									<li data-target="#monCarousel" data-slide-to="2"></li>
									<li data-target="#monCarousel" data-slide-to="3"></li>
							 </ol>
							<div class="carousel-inner" role="listbox">
									<div class="item active">
											  <img src="images/secure.png" style="width: 100% ;height:500px;"/>
											  <div class="carousel-caption">
												 <h3>Sécurité des Réseaux</h3>
											  </div>
									</div>
									
									 <div class="item">
											  <img src="images/switch.png" style="width: 100%;height:500px;"/>
											  <div class="carousel-caption">
												  <h4>Réseaux Informatiques</h4>
											  </div>
									</div>
									
									 <div class="item">
											  <img src="images/beach.jpg" style="width: 100%; height:500px;"/>
											  <div class="carousel-caption">
												 <h4>Waouhh...</h4>
											  </div>
									</div>
									
									<div class="item">
											  <img src="images/imag.jpg" style="width: 100%; height:500px;"/>
											  <div class="carousel-caption">
												 <h2>cool</h2>
											  </div>
									</div>
							</div>
							
                            <a href="#monCarousel"class="left carousel-control" role="button" data-slide="prev">
								 <span class="glyphicon glyphicon-chevron-left"></span>
						    </a>
						    <a href="#monCarousel"class="right carousel-control" role="button" data-slide="next">
								 <span class="glyphicon glyphicon-chevron-right"></span>
						    </a>
					  </div> 

					  <h2>Plus d'infos...</h2>

					  <?php

                        require('footer.php');

                   ?>
</body>
</html>