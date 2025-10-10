<?php
/**
 * Template Admin : gestion des commentaires d’un article
 * Variables attendues :
 *  - $article  : Article
 *  - $comments : Comment[]
 */
?>

<h2>Commentaires — « <?= htmlspecialchars($article->getTitle(), ENT_QUOTES) ?> »</h2>

<div class="adminArticle monitoringTotals">
    <div class="articleLine">
        <div class="title">Article</div>
        <div class="content"><?= htmlspecialchars($article->getTitle(), ENT_QUOTES) ?></div>
    </div>
    <div class="articleLine">
        <div class="title">Total commentaires</div>
        <div class="content"><?= count($comments) ?></div>
    </div>
</div>

<div class="adminArticle monitoringTable">
    <div class="articleLine articleLine--header">
        <div class="title">Auteur</div>
        <div class="content headerCell--wide">Commentaire</div>
        <div class="headerCell">Publié le</div>
        <div class="headerCell headerCell--narrow">Action</div>
    </div>

    <?php if (empty($comments)): ?>
        <div class="articleLine">
            <div class="title">—</div>
            <div class="content headerCell--wide">Aucun commentaire pour cet article.</div>
            <div class="headerCell">—</div>
            <div class="headerCell headerCell--narrow">—</div>
        </div>
    <?php else: ?>
        <?php foreach ($comments as $comment): ?>
            <div class="articleLine">
                <div class="title">
                    <?= htmlspecialchars($comment->getPseudo(), ENT_QUOTES) ?>
                </div>
                <div class="content headerCell--wide">
                    <?= Utils::format($comment->getContent()) ?>
                </div>
                <div class="headerCell">
                    <?= Utils::convertDateToFrenchFormat($comment->getDateCreation()) ?>
                </div>
                <div class="headerCell headerCell--narrow">
                    <a
                        class="submit"
                        href="index.php?action=deleteCommentAdmin&id=<?= $comment->getId() ?>&articleId=<?= $article->getId() ?>"
                        <?= Utils::askConfirmation("Supprimer ce commentaire ?") ?>
                    >Supprimer</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<p style="margin-top:10px;">
    <a class="submit" href="index.php?action=monitoring">← Retour Monitoring</a>
    <a class="submit" href="index.php?action=admin">← Retour Admin</a>
</p>
