<?php
//if user is connected
if(isset($_SESSION['connected'])) {
?>

<section id="administration" class='col-12'>
	<h2>Bienvenue, sur la page d'administration de : <em><?= $_SESSION['connected'] ?></em></h2>
	<hr />
	<p>Que souhaitez-vous faire ?</p>

	<div id="administration-menu" class="list-group">
		<a href="<?= cf_link('chapters/create'); ?>" class="list-group-item list-group-item-action active">Ecrire un article</a>
		<a href="<?= cf_link('comments/comment'); ?>" class="list-group-item list-group-item-action">Moderer un commentaire</a>
		<a href="<?= cf_link('users/user'); ?>" class="list-group-item list-group-item-action">Valider utilisateur</a>
	</div>
<?php
}
?>
</section>
