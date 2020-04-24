<?php
//if user is connected
if(isset($_SESSION['connected'])) {
?>

<p> Retour au <a href="<?= cf_link('users/administration') ?>"> menu d'administration</a></p>

<h1>Modifier l'article : <?= $chapter->getTitle(); ?></h1>

    <form method="post" action="<?= cf_link('chapters/' . $chapter->getId() ) ?>">
    	<div class="text-left form-group row">
    		<label for="updateTitle" class="col-sm-2 col-form-label col-form-label pl-0">Modifier le titre</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-sm" name="updateTitle" id="updateTitle" placeholder="Titre du chapitre" value="<?= $chapter->getTitle(); ?>"required />
		    </div>
		</div>
		<div class="form-group">
	    	<label for="updateContent">Modifiez votre chapitre</label>
			<textarea class="postContent form-control" name="updateContent" rows="10" required><?= htmlspecialchars($chapter->getContent()); ?></textarea>
			<input type="submit"  name="updateChapter" class="btn" value="Insérer le chapitre"  />
		</div>
    </form>

<?php
}
?>