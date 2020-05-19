<p> Retour au <a href="<?= cf_link('users/administration') ?>"> menu d'administration</a></p>

<h1>Valider vos collaborateurs</h1>
<h2>Liste des inscrits :</h2>

<?php 
foreach($users as $user) {
	if(!$user->isAdmin()){
	?>
	<form class="validation-admin-form input-group mb-3" method="post" action="<?= cf_link('users/' . $user->getId() .'/set'); ?>" >
		<input class="form-control" type="text" value="<?= htmlspecialchars($user->getEmail()); ?>" disabled="disabled" />
		<input type="hidden" name="show" value="<?= $user->isAdmin(); ?>">
		<div class="input-group-append">
			<button class="btn-outline-success" type="submit">Rendre administrateur</button>
		</div> 
	</form>
		<?php
	}else {
		?>
	<form class="validation-admin-form input-group mb-3" method="post" action="<?= cf_link('users/' . $user->getId() .'/unset'); ?>" >
		<input class="form-control" value="<?= htmlspecialchars($user->getEmail()); ?>" disabled="disabled" />
		<input type="hidden" name="hide" value="<?= $user->isAdmin(); ?>">
		<div class="input-group-append">
			<button class="btn-outline-danger" type="submit">Supprimer des administrateurs</button>
		</div> 
	</form>
		<?php
	}
}
?>
