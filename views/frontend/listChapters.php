<?php 

$title = "Le blog de l'écrivain";

//if user is connected
if(isset($_SESSION['connected'])) {
?>
    <p> Retour au <a href="<?= cf_link("users/administration") ?>"> menu d'administration</a></p>
<?php
}
?>

<h1>Les chapitres du livre</h1>

    <?php 
    foreach($chapters as $chapter) { 
    ?>
    <a href="chapters/<?= $chapter->getId() ?>" class="chapterLink">
        <div id="chapters">

            <div class="paragraphChapter">
                <?= $chapter->excerpt($chapter->getContent()); ?>
                <br />
                <a class ="btn btnListChapter" href="chapters/<?= $chapter->getId() . "#comment-form" ?>">Commentaires</a>
                <?php
                if(isset($_SESSION['connected'])) {
                ?>
                <form class="btn-form" action="<?= cf_link('chapters/' . $chapter->getId() . '/delete'); ?>" method="post">
                    <button class="btn-danger" type="button" data-toggle="modal" data-target="#deleteChapterModal">Supprimer</button>
                </form>
            </div>
            <?php
            }
            ?>

        </div>
    </a>
    <!-- Modal -->
    <div class="modal fade" id="deleteChapterModal" tabindex="-1" role="dialog" aria-labelledby="deleteChapterModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteChapterModalLabel">Suppression d'un chapitre</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Etes-vous sûr de vouloir supprimer ce chapitre, cette action est irréversible ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <form class="btn-form" action="<?= cf_link('chapters/' . $chapter->getId() . '/delete'); ?>" method="post">
                <button type="submit" name="deleteChapter" class="btn btn-primary">Supprimer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
    }
    ?>

