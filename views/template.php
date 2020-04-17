<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?= $title ?? "Billetsimplepourl'Alaska" ?></title>

	<link rel="stylesheet" href="<?= App\Tools\Helper::asset("css/style.css") ?>" />
	<link rel="shortcut icon" href="<?= App\Tools\Helper::asset("images/favicon.png") ?>" type="image/x-icon">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css" integrity="sha384-wxqG4glGB3nlqX0bi23nmgwCSjWIW13BdLUEYC4VIMehfbcro/ATkyDsF/AbIOVe" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- TinyMCE -->
	<script src="https://cdn.tiny.cloud/1/rng8m7ke1zb4kgxd5vr7onsop5h8c9kbzw91tvqs1upbeplm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


</head>
<body>
	<div id="wrap">
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top ">
			<a class="navbar-brand" href="<?= App\Tools\Helper::link("") ?>">Billet simple pour l'Alaska</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation-menu" aria-controls="navigation-menu" aria-expanded="false" >
				<span class="navbar-toggler-icon"></span>
			</button>
			<div id="navigation-menu" class="collapse navbar-collapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="<?= app\tools\Helper::link("chapters") ?>">Chapitres</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= App\Tools\Helper::link("author") ?>">Auteur</a>
					</li>
					<li class="nav-item">
					<a class="nav-link" href="<?= App\Tools\Helper::link("contact") ?>">Contact</a>
					</li>
				</ul>
				<?php
				if(App\Tools\Helper::isConnected()) {
					?>
					<a id="deconnection-btn" class="btn justify-content-end" href="<?= App\Tools\Helper::link("users/logout") ?>" name="logout" role="button">Deconnexion</a>
					<?php
				} else {
					?>
					<a class="regist_connect btn justify-content-end" href="<?= App\Tools\Helper::link("users/create") ?>" role="button" title="register">Inscription</a>
					<a class="regist_connect btn justify-content-end" href="<?= App\Tools\Helper::link("users/connection") ?>" role="button" title="connection">Connexion</a>
				<?php
				}
				?>
			</div>
		</nav>
		<div id='header-title'>
			<h1>BILLET SIMPLE POUR L'ALASKA</h1>
		</div>
	</header>

	<div class="container">

		<?= $content ?>

	</div>

	<!-- Footer -->

	<footer class="page-footer font-small bg-dark">
		<!-- Footer Elements -->
		<div class="container">
			<!-- Grid row-->
			<div class="row">
			<!-- Grid column -->
				<div class="col-md-12 py-0">
					<div class="mb-0 flex-center text-center">
						<!-- Facebook -->
						<a class="fb-ic">
							<i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
						</a>
						<!-- Twitter -->
						<a class="tw-ic">
							<i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
						</a>
						<!-- Google +-->
						<a class="gplus-ic">
							<i class="fab fa-google-plus-g fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
						</a>
						<!--Linkedin -->
						<a class="li-ic">
							<i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
						</a>
						<!--Instagram-->
						<a class="ins-ic">
							<i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
						</a>
						<!--Pinterest-->
						<a class="pin-ic">
							<i class="fab fa-pinterest fa-lg white-text fa-2x"> </i>
						</a>
					</div>
				</div>
				<!-- Grid column -->
				</div>
			<!-- Grid row-->
			</div>
			<!-- Copyright -->
			<div class="footer-copyright text-center py-3 darken">© 2020 Copyright: JeanForteroche
			<a href="#">Politique de confidentialité</a>
			</div>
		</footer>
	</div>

	<!--Liens pour utilisation de javascript et autres frameworks -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="<?= App\Tools\Helper::asset("scripts/main.js") ?>"></script>
</body>
</html>