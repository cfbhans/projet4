<?php 

$title = "Le blog de l'écrivain";

//if user is connected
if(isset($_SESSION['connected'])) {
?>
    <p> Retour au <a href="<?= App\Tools\Helper::link("users/administration") ?>"> menu d'administration</a></p>
<?php
}
?>

<h1>Commentez les chapitres!</h1>

<div id="chapters">
    <div class="paragraphChapter">
        <h3>
            <?= htmlspecialchars($chapter->getTitle()); ?><br />
        </h3>
        <div class="note">écrit le <?= htmlspecialchars($chapter->getCreatedat()); ?></div>
        <br />
        <p>
        <?= nl2br(htmlspecialchars($chapter->getContent())); ?>
        </p>
    </div>
</div>
<hr>
<div class="col-12">
    <h2>Ajouter un commentaire à ce chapitre : </h2>
    <form id="comment-form" action="<?= App\Tools\Helper::link('comments/create/' . htmlspecialchars($chapter->getId())); ?>" method="POST">
        <?php
        if(App\Tools\Helper::hasErrors()){
            foreach ($_SESSION['errors'] as $error) {
                echo '<p class="alert alert-warning" role="alert">' . $error . '</p>';  
            };
        }
        ?>
        <div class="form-group row">
            <label for="author" class="col-sm-2 col-form-label">Auteur</label><br />
            <input type="text"  class="form-control col-sm-8" id="author" name="author" value="<?= App\Tools\Helper::hasErrors() ? $_POST['author'] : ""; ?>" required="required" />
        </div>
        <div class="form-group row">
            <label for="comment" class="col-sm-2 col-form-label">Commentaire</label><br />
            <textarea class="form-control col-sm-8" id="comment" name="comment" required="required"><?= App\Tools\Helper::hasErrors() ? $_POST['comment'] : ""; ?></textarea>
        </div>
            <input type="submit" name="addComment" class="btn" value="Envoyer"/>
    </form>
</div>
<hr />

<section id="comments">
    <h4>Quelques commentaires</h4>
<?php
if (is_array($comments) && !empty($comments))
{
    foreach($comments as $comment)
    {
    ?>
    <div class="comments col-12">
        <p><strong><?= htmlspecialchars($comment->getAuthor()) ?></strong> le <?= $comment->getCommented(); ?></p>
        <p><?= nl2br(htmlspecialchars($comment->getComment())); ?></p>
        <hr>

        <?php 
        if($comment->getIsReported() && $comment->getEnum() != "confirmed") { 
            ?>
            <p class="isReported">Ce commentaire a déjà été signalé ! Nous nous efforçons de le modérer rapidement. Merci de votre aide.</p>
            <?php
            if(isset($_SESSION['connected'])) {
                ?>
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
            <?php
            }

        } elseif ($comment->getEnum() != "pending") { ?>
            <p>Ce commentaire a été modéré par l'administrateur.</p>
        <?php
        }else { ?>

        <form class="reported-form" action="<?= App\Tools\Helper::link('comments/'. $comment->getId() . '/report'); ?>" method="POST">
            <input type="hidden" name="chapterId" value="<?= $chapter->getId() ?>">
            <input class="btn-danger" type="submit" name="reported" value="Signaler"/>
        </form>
        <?php
        }
        ?>
    </div>
    <?php
    }
} else {
    ?>
    <p>Il n'y a pas encore de commentaire pour ce chapitre.</p>
<?php
}
?>
</section>