<section>
	<h2 class="text-center">Bienvenue sur la page d'inscription</h2>
</section>

<div>
	<div class="errors">
		
	</div>

	<!-- display form register -->
	<div id="register">
		<form  id="register-form" action="<?= App\Tools\Helper::link('users')?>" method="POST">
		<?php
		if(isset($_SESSION['errors'])){
			foreach ($_SESSION['errors'] as $error) {
				echo '<p class="alert alert-danger" role="alert">' . $error . '</p>';  
			};
		}
		?>
			<fieldset>
				<legend>Vous inscrire en tant qu'administrateur : <em class="note">(il n'est possible de s'inscrire qu'avec la validation de Jean Forteroche)</em></legend>
				<div class="col-md-12">
					<div class="form-group col-md-12">
					<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Identifiant" />
					</div>
					<div class="form-group col-md-12">
						<label for="password">Mot de passe</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe"/>
					</div>
					<div class="form-group col-md-12">
						<label for="confirmPassword">Vérification du Mot de passe</label>
						<input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Vérification du mot de passe" />
					</div>
					<input type="submit" name="register" class="btn" value="Je m'inscris" />
				</div>
			</fieldset>
		</form>
	</div>
</div>