<p> Retour au <a href="<?= cf_link('users/administration') ?>"> menu d'administration</a></p>

<h1>Valider vos collaborateurs</h1>
<h2>Liste des inscrits :</h2>
<div>
	<?php 
	foreach($users as $user) {
		if(!$user->isAdmin()){
		?>
		<div id="form-admin">
			<form class="btn-form" action="<?= cf_link('users/' . $user->getId() .'/delete'); ?>" method="post">
				<button class="btn-danger" type="submit" name="deleteUser" id="deleteUser"><svg class="bi bi-trash-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
				</svg></button>
			</form>
			<form class="validation-admin-form input-group mb-3" method="post" action="<?= cf_link('users/' . $user->getId() .'/set'); ?>" >
				<input class="form-control" type="text" value="<?= htmlspecialchars($user->getEmail()); ?>" disabled="disabled" />
				<input type="hidden" name="show" value="<?= $user->isAdmin(); ?>">
				<div class="input-group-append">
					<button class="btn-outline-success" type="submit">Rendre administrateur</button>
				</div> 
			</form>
		</div>
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
		<?php } ?>
	<?php } ?>
</div>
