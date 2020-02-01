<?php
use ItForFree\SimpleMVC\Config;
$Url = Config::getObject('core.url.class');
$User = \application\models\ExampleUser::get();
?>

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

