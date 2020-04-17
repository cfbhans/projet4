<section>
	<h2 class="text-center">Bienvenue sur la page de connexion</h2>
</section>

<section>
	<!-- display form connection -->
	<div id="connection">
		<form id="connection-form" action="<?= App\Tools\Helper::link('users/administration') ?>" method="POST">
		<?php
		if(isset($_SESSION['errors'])){
			foreach ($_SESSION['errors'] as $error) {
				echo '<p class="alert alert-danger" role="alert">' . $error . '</p>';  
			};
		}
		?>
			<fieldset>
				<legend>Pour accéder à l'espace administration, merci de vous identifier :</legend>  
				<div class="col-md-12">
					<div class="form-group col-md-12">
						<label for="emailConnect">Identifiant</label>
						<input type="text" class="form-control" id="emailConnect" name="emailConnect" placeholder="email" />
					</div>
					<div class="form-group col-md-12">
						<label for="passwordConnect">Mot de passe</label>
						<input type="password" class="form-control" id="passwordConnect" name="passwordConnect" placeholder="Mot de passe" />
					</div>
					<input type="submit" name="connection" class="btn" value="Connexion" />
				</div>
			</fieldset>
		</form>
	</div>
</section>
