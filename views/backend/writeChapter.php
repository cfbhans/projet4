<p> Retour au <a href="<?= cf_link('users/administration') ?>"> menu d'administration</a></p>

<h1>Ecrire un nouvel article pour votre blog</h1>
<h2>Prochain chapitre</h2>

<form method="POST" action="<?= cf_link('chapters') ?>">
	<div class="text-left form-group row">
		<label for="newPostTitle" class="col-sm-2 col-form-label col-form-label pl-0">Titre du chapitre</label>
		<div class="col-sm-10">
			<input type="text" class="form-control form-control-sm" name="newPostTitle" id="newPostTitle" placeholder="Titre du chapitre" required="required" />
		</div>
	</div>
	<div class="form-group">
		<label for="newPostContent">Ecrivez votre chapitre</label>
		<textarea id="newPostContent" class="postContent form-control" name="newPostContent"></textarea>
		<input type="submit"  name="addChapter" class="btn" value="Insérer le chapitre" />
	</div>
</form>