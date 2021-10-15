<?php require \Helpers\get_fragment_path('__header') ?>

<div class="container">
<h2>Вход</h2>
    <form class="w-25" action="" method="POST">
        <label class="form-label">Имя</label>
        <input type="text" class="form-control" name='name' value="<?= $form['name'] ?>">
        <?php \Helpers\show_errors('name', $form) ?>
        <label class="form-label">Пароль</label>
        <input type="password" class="form-control" name="password" >
        <?php \Helpers\show_errors('password', $form) ?>
        <input class="btn btn-outline-secondary" type="submit" value="Войти">
    </form>
</div>

<?php require \Helpers\get_fragment_path('__footer') ?>
