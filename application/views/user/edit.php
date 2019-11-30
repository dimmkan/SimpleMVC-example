<?php 
use ItForFree\SimpleMVC\Config;

$Url = Config::getObject('core.url.class');
$User = Config::getObject('core.user.class');
?>

<?php include('includes/admin-users-nav.php'); ?>


<h2><?= $editAdminusersTitle ?>
    <span>
        <?= $User->returnIfAllowed("admin/adminusers/delete", 
            "<a href=" . $Url::link("admin/adminusers/delete&id=" . $_GET['id']) 
            . ">[Удалить]</a>");?>
    </span>
</h2>

<form id="editUser" method="post" action="<?= $Url::link("admin/adminusers/edit&id=" . $_GET['id'])?>">
    <h5>Введите имя пользователя</h5>
    <input type="text" class="form-control" name="login" placeholder="логин пользователя" value="<?= $viewAdminusers->login ?>"><br>
    <h5>Введите пароль</h5>
    <input type="text" class="form-control" name="pass" placeholder="новый пароль" value=""><br>
    <h5>Введите e-mail</h5>
    <input type="text" class="form-control" name="email"  placeholder="email" value="<?= $viewAdminusers->email ?>"><br>
    <!-- Добавили вывод роли -->
    <h5>Выберите роль пользователя</h5>
    <select name="role" id="role" class="form-control">
        <option <?php echo (($viewAdminusers->role == "admin") ? "selected" : ""); ?> value="admin">Администратор</option>
        <option <?php echo (($viewAdminusers->role == "auth_user") ? "selected" : ""); ?> value="auth_user">Зарегистрированный пользователь</option>
    </select>

    <br>

    <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
    <input type="submit" class="btn btn-primary" name="saveChanges" value="Сохранить">
    <input type="submit" class="btn" name="cancel" value="Назад">
</form>
