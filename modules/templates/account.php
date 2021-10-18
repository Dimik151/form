<?php require \Helpers\get_fragment_path('__header') ?>

<div class="container">
    <h2>Профиль пользователя: <?= $user['name'] ?></h2>
    <p>Логин: <?= $user['name'] ?></p>
    <p>Имя: <?= $user['name1'] ?></p>
    <p>Фамилия: <?= $user['name2'] ?></p>
    <p>Email: <?= $user['email'] ?></p>
</div>

<div class="container">
    <form action="" method="POST">
        <a class="btn btn-outline-secondary" href="/users/<?= $__current_user['name'] ?>/account/edit/">Изменить данные</a>
        <a class="btn btn-outline-secondary" href="/users/<?= $__current_user['name'] ?>/account/editpassword/">Смена пароля</a>
        <a class="btn btn-outline-secondary" href="/users/<?= $__current_user['name'] ?>">Мои статьи</a>
        <a class="btn btn-outline-secondary" href="<?= '/users/' . $user['name'] . '/articles/add' . $gets ?>">Добавить статью</a>
        <a class="btn btn-outline-secondary" href="">Мои комментарии</a>
        <a class="btn btn-outline-secondary" href="/users/<?= $__current_user['name'] ?>/account/delete">Удалить пользователя</a>
    </form>
</div>

<?php require \Helpers\get_fragment_path('__footer') ?>