<?php
/**
 * Template Monitoring (admin)
 * Affiche : totaux, puis liste des articles avec vues & nb commentaires.
 * Variables attendues :
 *  - $globalStats : ['total_articles' => int, 'total_comments' => int, 'total_views' => int]
 *  - $articlesWithStats : [ ['article' => Article, 'nb_comments' => int], ... ]
 */

// Fonction pour générer les liens de tri
function sortLink(string $label, string $col, string $currentSort, string $currentDir): string {
    $nextDir = ($currentSort === $col && $currentDir === 'asc') ? 'desc' : 'asc';
    $arrow   = '';
    if ($currentSort === $col) {
        $arrow = $currentDir === 'asc' ? ' ▲' : ' ▼';
    }
    $href = "index.php?action=monitoring&sort={$col}&dir={$nextDir}";
    return '<a href="'.$href.'" class="sortable" title="Trier">'.$label.$arrow.'</a>';
}
?>

<h2>Monitoring du site</h2>

<!-- Bloc totaux -->
<div class="adminArticle monitoringTotals">
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
<div class="adminArticle monitoringTable">
    <div class="articleLine articleLine--header">
        <div class="title">
            <?= sortLink('Titre', 'title', $sort, $dir) ?>
        </div>
        <div class="content headerCell--wide">
            <?= sortLink('Extrait', 'title', $sort, $dir) ?>
        </div>
        <div class="headerCell">
            <?= sortLink('Créé le', 'date_creation', $sort, $dir) ?>
        </div>
        <div class="headerCell">
            <?= sortLink('Maj le', 'date_update', $sort, $dir) ?>
        </div>
        <div class="headerCell--narrow">
            <?= sortLink('Vues', 'views', $sort, $dir) ?>
        </div>
        <div class="headerCell headerCell--comments">
            <?= sortLink('Commentaires', 'nb_comments', $sort, $dir) ?>
        </div>
    </div>

    <?php foreach ($articlesWithStats as $row): ?>
        <?php
            /** @var Article $a */
            $a = $row['article'];
            $nbComments = (int)$row['nb_comments'];
        ?>
        <div class="articleLine">
            <div class="title"><?= htmlspecialchars($a->getTitle(), ENT_QUOTES) ?></div>
            <div class="content"><?= htmlspecialchars($a->getContent(120), ENT_QUOTES) ?></div>
            <div class="headerCell">
                <?= $a->getDateCreation() ? Utils::convertDateToFrenchFormat($a->getDateCreation()) : '-' ?>
            </div>
            <div class="headerCell">
                <?= $a->getDateUpdate() ? Utils::convertDateToFrenchFormat($a->getDateUpdate()) : '-' ?>
            </div>
            <div class="headerCell--narrow">
                <?= (int)$a->getViews() ?>
            </div>
            <div class="headerCell headerCell--comments">
                <?= $nbComments ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<a class="submit" href="index.php?action=admin">Retour admin</a>