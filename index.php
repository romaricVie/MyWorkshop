<!-- Page accueil-->
<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
	  <title>welcome</title>
	  <meta name="viewport" content="width=device-width,initial-scale=1">
	  <script src="assets/jquery/jquery-3.3.1.min.js"></script>
	  <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" type="text/css" href="style.menu.css">
</head>
<body>
    <header>
		        <nav class="navbar navbar-inverse navbar-fixed-top" style="">
						
						  <div class="container-fluid" >
									<div class="navbar navbar-header">
										 <button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#monMenu">
										 	<!--Menu responsive 3 barre icons-->
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
										  </button>
									
									      <a href="#" class="navbar-brand">MyWorkshop</a>
									</div>
									<!--Menu responsive ouverture du menu a partir des 3 barres icons-->
								    <div class="collapse navbar-collapse" id="monMenu">
                                         <ul class="nav navbar-nav">
                                         	<li><a href="#"><span class='glyphicon glyphicon-home'></span> Accueil</a></li>
											<li><a href="register.php"><span class='glyphicon glyphicon-pencil'></span> Je m'inscris</a></li>
											<li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Je me connecte</a></li>
											<li><a href="contact.php"><span class='glyphicon glyphicon-phone'></span>Nous Contacter</a></li>
											<li><a href="equipe.php">Qui sommes nous?</a></li>

                                        </ul>
							    </div> 
						 </div>
				</nav>
		 </header>
		 <h1 style="margin-top: 70px; text-align: center">Bienvenue sur note site.</h1>
		 <h2 style="text-align: center">En quoi pouvons-nous vous aidez?</h2>

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