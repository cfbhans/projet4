<?php 

$title = "Le blog de l'écrivain";

//if user is connected
if(isset($_SESSION['connected'])) {
?>
    <p> Retour au <a href="<?= App\Tools\Helper::link("users/administration") ?>"> menu d'administration</a></p>
<?php
}
?>



<h1>Les chapitres !</h1>
<p>Derniers chapitres du livre :</p>

    <div id="chapters">
        <?php 
        foreach($chapters as $chapter) { 
        ?>
        <h3>
            <?= htmlspecialchars($chapter->getTitle()) ?><br />
            <em><?= $chapter->getCreatedat() ?></em>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($chapter->excerpt($chapter->getContent()))); ?>
            <br />
            <em><a class ="btn" href="chapters/<?= $chapter->getId() ?>">Lire la suite...</a></em>
            <em><a class ="btn" href="chapters/<?= $chapter->getId() . "#comment-form" ?>">Commentaires</a></em>
            <?php 
            if(isset($_SESSION['connected'])) {
            ?>
                <em><a class ="btn" href="chapters/<?= $chapter->getId() ?>/edit">Modifier le chapitre</a></em>
            <?php
            }
            ?>
        </p>
        <?php
        }
        ?>

    </div>
<!--     <div class="d-flex justify-content-between my-4">
        <?php 
        foreach($pages as $page) {?>
            <a href="chapters/page-<?= $chapter->getCurrentPage(0, 5) ?>"> <?php echo $page; ?> </a>

            <?php
            }
        ?>
    </div> -->
