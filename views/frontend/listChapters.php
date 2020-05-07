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
                
            </div>

        </div>
    </a>
    <?php
    }
    ?>

