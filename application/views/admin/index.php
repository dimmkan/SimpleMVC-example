<?php
use ItForFree\SimpleMVC\Config;
$Url = Config::getObject('core.url.class');
$User = \application\models\ExampleUser::get();
?>
<div id="container">
<div id="adminHeader">
    <h2>Widget News Admin</h2>
    <p>You are logged in as <b><?php echo htmlspecialchars($User->userName) ?></b>.
        <a href="<?= $Url::link('admin/admin/') ?>">Edit Articles</a>
        <a href="<?= $Url::link('admin/admin/listCategories') ?>">Edit Categories</a>
        <?php
        if($User->role == 'admin'){
            echo "<a href=".$Url::link('admin/admin/listUsers').">Список пользователей</a>";
        }
        ?>
        <a href="<?= $Url::link('admin/admin/listSubcategories') ?>">Список подкатегорий</a>
        <a href="<?= $Url::link('admin/login/logout') ?>"?>Log Out</a>
    </p>
</div>
</div>
<div id="container">
    <h1>All Articles</h1>

    <?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
    <?php } ?>


    <?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
    <?php } ?>

    <table>
        <tr>
            <th>Publication Date</th>
            <th>Article</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Actions</th>
            <th>Authors</th>
        </tr>

        <!--<?php echo "<pre>"; print_r ($results['articles'][2]->publicationDate); echo "</pre>"; ?> Обращаемся к дате массива $results. Дата = 0 -->

        <?php foreach ( $results['results'] as $article ) { ?>

            <tr onclick="location='<?= $Url::link("admin/admin/editArticle&id=".$article->id)?>'">
                <td><?php echo date('j M Y', strtotime($article->publicationDate))?></td>
                <td>
                    <?php echo $article->title?>
                </td>
                <td>

                    <!--   <?php echo $results['categories'][$article->categoryId]->name?> Эта строка была скопирована с сайта-->
                    <!-- <?php echo "<pre>"; print_r ($article); echo "</pre>"; ?> Здесь объект $article содержит в себе только ID категории. А надо по ID достать название категории-->
                    <!--<?php echo "<pre>"; print_r ($results); echo "</pre>"; ?> Здесь есть доступ к полному объекту $results -->

                    <?php
                    if(isset ($article->categoryId)) {
                        echo $results['categories'][$article->categoryId]->name;
                    }
                    else {
                        echo "Без категории";
                    }?>
                </td>
                <td>
                    <?php
                    if(isset ($article->subcategoryId)) {
                        echo $results['subcategories'][$article->subcategoryId]->description;
                    }
                    else {
                        echo "Без подкатегории";
                    }?>
                </td>
                <td>
                    <?php echo $article->actions?>
                </td>
                <td>
                    <?php
                    if(isset($results['authors'])) {
                        $res = "";
                        foreach ($results['authors'] as $author) {
                            $res .= (in_array($author->id, $article->authors)) ? htmlspecialchars($author->login) . "\r\n" : "";
                        }
                        echo $res;
                    }
                    ?>
                </td>
            </tr>

        <?php } ?>

    </table>

    <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>

    <p><a href="<?= $Url::link("admin/admin/newArticle")?>">Add a New Article</a></p>
</div>

