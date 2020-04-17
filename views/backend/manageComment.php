<?php
//if user is connected
if(isset($_SESSION['connected'])) {
?>
<p> Retour au <a href="<?= App\Tools\Helper::link("users/administration") ?>"> menu d'administration</a></p>
<section id="manageComment">
	<h2>Gerer les commentaires des lecteurs :</h2>
	<hr />
	<p>Voici les commentaires signalés que vous devez modérer :</p>

	<?php
	if(count($comments) == 0){
		echo "Vous n'avez pas de commentaire à modérer ! ";
	} else {
		foreach ($comments as $comment) {
		
		?>
		<div class="input-group mb-3">
	    <p class="form-control comment-form" ><b>Commentaires à modérer : </b> <?= $comment->getComment(); ?> </p>
	        <div class="input-group-append">
			<form class="btn-form" action="<?= cf_link('comments/' . $comment->getId() . '/edit'); ?>" method="get">
				<button class="btn-secondary" type="submit" name="moderationComment">Modérer</button>
			</form>
			<form class="btn-form" action="<?= cf_link('comments/' . $comment->getId() . '/delete'); ?>" method="post">
				<button class="btn-danger" type="submit" name="deleteComment">Supprimer</button>
			</form>
			<form class="btn-form" action="<?= cf_link('comments/' . $comment->getId() .'/confirm'); ?>" method="post">
				<button class="btn-success" type="submit" name="confirmComment">Confirmer</button>
			</form>    
	        </div> 
        </div>

	<?php
		}
	}
}
	?>