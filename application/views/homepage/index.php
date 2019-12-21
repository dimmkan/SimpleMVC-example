<div class="row">
    <div class="col "><h1><?php echo $homepageTitle ?></h1>
        </div>
</div>
<div class="row">
    <div class="col ">
      <p class="lead"> Добро пожаловать в SimpleMVC! </p>
    </div>
</div>
<div class="row">
    <?php foreach ($results['results'] as $article) { ?>
    <li class='<?php echo $article->id?>'>
        <h2>
                <span class="pubDate">
                    <?php echo date('j F', strtotime($article->publicationDate))?>
                </span>

            <a href="/viewArticle?articleId=<?php echo $article->id?>">
                <?php echo htmlspecialchars($article->title)?>
            </a>

            <?php if (isset($article->categoryId)) { ?>
                <span class="category">
                        in
                        <a href="/archive?categoryId=<?php echo $article->categoryId?>">
                            <?php echo htmlspecialchars($results['categories'][$article->categoryId]->name)?>
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
                        <a href=".?action=archive&amp;subcategoryId=<?php echo $article->subcategoryId?>">
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
    </li>
    <?php } ?>
</div>