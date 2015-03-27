// ...
<?php foreach ($articles as $article): ?>
<article>
    <h2><?php echo $article->getTitle() ?></h2>
    <p><?php echo $article->getContent() ?></p>
</article>
<?php endforeach ?>
// ...