<?php
/**
 * Template Monitoring (admin)
 * Affiche : totaux, puis liste des articles avec vues & nb commentaires.
 * Variables attendues :
 *  - $globalStats : ['total_articles' => int, 'total_comments' => int, 'total_views' => int]
 *  - $articlesWithStats : [ ['article' => Article, 'nb_comments' => int], ... ]
 */
?>

<h2>Monitoring du site</h2>

<!-- Bloc totaux -->
<div class="adminArticle">
    <div class="articleLine">
        <div class="title">Total articles</div>
        <div class="content"><?= (int)$globalStats['total_articles'] ?></div>
    </div>
    <div class="articleLine">
        <div class="title">Total commentaires</div>
        <div class="content"><?= (int)$globalStats['total_comments'] ?></div>
    </div>
    <div class="articleLine">
        <div class="title">Total vues</div>
        <div class="content"><?= (int)$globalStats['total_views'] ?></div>
    </div>
</div>

<!-- Tableau articles -->
<div class="adminArticle">
    <div class="articleLine">
        <div class="title">Titre</div>
        <div class="content">Extrait</div>
        <div>Créé le</div>
        <div>Maj le</div>
        <div>Vues</div>
        <div>Commentaires</div>
    </div>

    <?php foreach ($articlesWithStats as $row) {
        /** @var Article $a */
        $a = $row['article'];
        $nbComments = $row['nb_comments'];
    ?>
        <div class="articleLine">
            <div class="title"><?= htmlspecialchars($a->getTitle(), ENT_QUOTES) ?></div>
            <div class="content"><?= htmlspecialchars($a->getContent(120), ENT_QUOTES) ?></div>
            <div>
                <?= $a->getDateCreation() ? Utils::convertDateToFrenchFormat($a->getDateCreation()) : '-' ?>
            </div>
            <div>
                <?= $a->getDateUpdate() ? Utils::convertDateToFrenchFormat($a->getDateUpdate()) : '-' ?>
            </div>
            <div>
                <?= $a->getViews() ?>
            </div>
            <div>
                <?= $nbComments ?>
            </div>
        </div>
    <?php } ?>
</div>

<a class="submit" href="index.php?action=admin">Retour admin</a>
