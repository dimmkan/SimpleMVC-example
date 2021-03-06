<?php
use ItForFree\SimpleMVC\Config;

$Url = Config::getObject('core.url.class');
?>
<div id="container">
    <a href="/"><img id="logo" src="/images/logo.jpg" alt="Widget News" /></a>
<ul id="headlines">
    <?php foreach ($results['results'] as $article) { ?>
        <li class='<?php echo $article->id?>'>
            <h2>
                <span class="pubDate">
                    <?php echo date('j F', strtotime($article->publicationDate))?>
                </span>

                <a href="<?= $Url::link("viewArticle/&id=".$article->id)?>">
                    <?php echo htmlspecialchars( $article->title )?>
                </a>

                <?php if (isset($article->categoryId)) { ?>
                    <span class="category">
                        in
                        <a href="<?= $Url::link("archive/byCategory&categoryId=".$article->categoryId)?>">
                            <?php echo htmlspecialchars($results['categories'][$article->categoryId]->name )?>
                        </a>
                    </span>
                <?php }
                else { ?>
                    <span class="category">
                        <?php echo "Без категории"?>
                    </span>
                <?php } ?>

                <?php if (isset($article->subcategoryId)) { ?>
                    <span class="category">
                        in
                        <a href="<?= $Url::link("archive/bySubcategory&subcategoryId=".$article->subcategoryId)?>">
                            <?php echo htmlspecialchars($results['subcategories'][$article->subcategoryId]->description)?>
                        </a>
                    </span>
                <?php }
                else { ?>
                    <span class="category">
                        <?php echo "Без подкатегории"?>
                    </span>
                <?php } ?>
            </h2>
            <p class="summary<?php echo $article->id?>"><?php echo htmlspecialchars($article->shortContent)?></p>

            <ul class="ajax-load">
                <li><a href="<?= $Url::link("viewArticle/&id=".$article->id)?>" class="ajaxArticleBodyByPost" data-contentId="<?php echo $article->id?>">Показать продолжение (POST)</a></li>
                <li><a href="<?= $Url::link("viewArticle/&id=".$article->id)?>" class="ajaxArticleBodyByGet" data-contentId="<?php echo $article->id?>">Показать продолжение (GET)</a></li>
                <li><a href="<?= $Url::link("viewArticle/&id=".$article->id)?>" class="newAjaxPost" data-contentId="<?php echo $article->id?>">(POST) -- NEW</a></li>
                <li><a href="<?= $Url::link("viewArticle/&id=".$article->id)?>" class="newAjaxGet" data-contentId="<?php echo $article->id?>" >(GET)  -- NEW</a></li>
            </ul>
            <a href="<?= $Url::link("viewArticle/&id=".$article->id)?>" class="showContent" data-contentId="<?php echo $article->id?>">Показать полностью</a>
            <?php if(isset($results['authors'])) { ?>
            <span class="category">
                    <?php
                    $res = "";
                    foreach ($results['authors'] as $author) {
                        if (in_array($author->id, $article->authors)) {
                            ?>
                            <a href="/viewArticleByAuthor?authorId=<?php echo (in_array($author->id, $article->authors)) ? $author->id : "0"; ?>"><?php echo(in_array($author->id, $article->authors)) ? htmlspecialchars($author->login) : ""; ?></a>
                        <?php }
                    }
                    ?>
                </span>
            <?php } ?>
        </li>
    <?php } ?>
</ul>
<p><a href="<?=$Url::link("archive/")?>">Article Archive</a></p>
    <div id="footer">
        <a href="<?= $Url::link("admin/login/")?>">Site Admin</a>
    </div>
</div>