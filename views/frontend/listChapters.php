<?php 

$title = "Le blog de l'écrivain";

//if user is connected
if(isset($_SESSION['connected'])) {
?>
    <p> Retour au <a href="<?= App\Tools\Helper::link("users/administration") ?>"> menu d'administration</a></p>
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
                    <a class ="btn btnListChapter" href="chapters/<?= $chapter->getId() ?>/edit">Modifier le chapitre</a>
                <?php
                }
                ?>
            </div>

        </div>
    </a>
    <?php
    }
    ?>
<!--     <div class="d-flex justify-content-between my-4">
        <?php 
        foreach($pages as $page) {?>
            <a href="chapters/page-<?= $chapter->getCurrentPage(0, 5) ?>"> <?php echo $page; ?> </a>

            <?php
            }
        ?>
    </div> -->
