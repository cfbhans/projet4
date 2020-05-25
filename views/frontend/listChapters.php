<?php 
//if user is connected
if(isset($_SESSION['connected'])) { 
	?>
	<p> Retour au <a href="<?= cf_link("users/administration") ?>"> menu d'administration</a></p>
<?php } ?>

<h2>Les chapitres du livre</h2>

<?php foreach($chapters as $chapter) { ?>
	<div class="chapters_id">

		<div class="paragraphChapter">
			<a href="chapters/<?= $chapter->getId() ?>" class="chapterLink">
				<h3><?= $chapter->getTitle(); ?></h3>
				<?= $chapter->excerpt($chapter->getContent()); ?>
				<br />
				<?php if(isset($_SESSION['connected'])) { ?>
					<form class="btn-form" action="<?= cf_link('chapters/' . $chapter->getId() .'/delete'); ?>" method="post">
						<button class="btn-danger" type="submit" name="deleteChapter" id="deleteChapter">Supprimer</button>
					</form>
				<?php } ?>
			</a>
			<a class="btn btnListChapter" href="chapters/<?= $chapter->getId() . "#comment-form" ?>">Commentaires</a>
		</div>

	</div>
	
<?php } ?>

