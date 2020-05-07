<?php
//if user is connected
if(isset($_SESSION['connected'])) {
?>
<p> Retour au <a href="<?= cf_link("users/administration") ?>"> menu d'administration</a></p>
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
			
				<button class="btn-danger" type="button" data-toggle="modal" data-target="#deleteCommentModal">Supprimer</button>
			
			<form class="btn-form" action="<?= cf_link('comments/' . $comment->getId() .'/confirm'); ?>" method="post">
				<button class="btn-success" type="submit" name="confirmComment">Confirmer</button>
			</form>    
	        </div> 
        </div>


<!-- Modal -->
<div class="modal fade" id="deleteCommentModal" tabindex="-1" role="dialog" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteCommentModalLabel">Suppression d'un commentaire</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Etes-vous sûr de vouloir supprimer ce commentaire ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <form class="btn-form" action="<?= cf_link('comments/' . $comment->getId() . '/delete'); ?>" method="post">
        	<button type="submit" name="deleteComment" class="btn btn-primary">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>
	<?php
		}
	}
}
	?>