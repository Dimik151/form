<?php require \Helpers\get_fragment_path('__header'); ?>
<?php $gets = \Helpers\get_GET_params(['page'], ['ref' => 'item']) ?>

<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5"><?= $artic['title'] ?></h1>
        <p class="lead"><?= $artic['description'] ?></p>
        <div style="display: flex; justify-content: space-between;">
            <p><?= \Helpers\get_formatted_timestamp($artic['uploaded']) ?></p>
            <p><?= $artic['user_name'] ?></p>
        </div>
        <?php if ($__current_user && ($__current_user['id'] == $artic['user_id'] || $__current_user['admin'])) { ?>
            <div style="display: flex; justify-content: space-between">
                <p><a class="btn btn-outline-secondary" href="<?= '/users/' . $artic['user_name'] . '/articles/' . $artic['id'] . '/edit' . $gets ?>">Изменить статью</a></p>
                <p><a class="btn btn-outline-secondary" href="<?= '/users/' . $artic['user_name'] . '/articles/' . $artic['id'] . '/delete' . $gets ?>">Удалить статью</a></p>
            </div>
        <?php } ?>
    </div>
</main>
<?php if ($__current_user) { ?>
    <?php require \Helpers\get_fragment_path('__comment_form') ?>
    <?php $u2 = \Helpers\get_GET_params(['page', 'filter', 'ref']) ?>
<?php } ?>

<div class="container">
    <form action="" method="GET">
        <div class="w-25">
            <h1 class="mt-5">Комментарии</h1>
            <span class="input-group-text">Упорядочить</span>
            <select class="form-select" name='sort'>
                <option value="uploaded" <?= $save['uploaded'] ?>>По дате добавления</option>
                <option value="users" <?= $save['users'] ?>>По имени</option>
            </select>
            <input class="btn btn-primary" type="submit" value="Показать">
        </div>
    </form>
    <?php foreach ($comment as $comm) { ?>
        <h3 class="mt-3"><?= $comm['user_name'] ?></h3>
        <p class="lead"><?= $comm['content'] ?></p>
        <p><?= \Helpers\get_formatted_timestamp($comm['uploaded']) ?></p>
        <?php if ($__current_user && ($__current_user['id'] == $comm['user_id'] || $__current_user['admin'])) { ?>
            <?php $u1 = '/' . $artic['id'] . '/comments/' . $comm['id'] ?>
            <p>
                <a class="btn btn-primary" href="<?= $u1 . '/edit' . $u2 ?>">Исправить</a>
                <a class="btn btn-primary" href="<?= $u1 . '/delete' . $u2 ?>">Удалить</a>
            </p>
        <?php } ?>
        <hr>
    <?php } ?>
</div>

<?php require \Helpers\get_fragment_path('__footer'); ?>