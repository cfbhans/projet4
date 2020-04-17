<?php
//if user is connected
if(isset($_SESSION['connected'])) {
?>
<p> Retour au <a href="<?= App\Tools\Helper::link("users/administration") ?>"> menu d'administration</a></p>

<section id="moderationComment">
	<h1>Modifier le commentaire</h1>

    <p>Ce commentaire a été laissé dans le chapitre</p>
    <form method="post" action="<?= cf_link('comments/' . $comment->getId() .'/moderate' ); ?>">
        <div class="text-left form-group row">
            <label for="upAuthor" class="col-sm-2 col-form-label col-form-label pl-0">Modifier l'auteur</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="upAuthor" id="upAuthor" value="<?= $comment->getAuthor(); ?>"required />
            </div>
        </div>
        <div class="form-group">
            <label for="upComment">Modifiez le commentaire</label>
            <textarea id="upComment" class="form-control" name="upComment" rows="10"><?= $comment->getComment(); ?></textarea>
        </div>
        <input type="submit" name="upBtnComment" class="btn" value="Modifier" />
    </form>
</section>
<?php
}
?>

