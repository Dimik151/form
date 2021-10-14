<?php require \Helpers\get_fragment_path('__header'); ?>
<?php $gets = \Helpers\get_GET_params(['page'], ['ref' => 'item']) ?>

<?php 
// if (isset($_GET['sort']) && !empty($_GET['sort']))
//     $mediaType = $_GET['sort'];
// else 
//     $mediaType = 'uploaded';

// function mediaSelected($type) {
//     global $mediaType;
//     if ($mediaType == $type)
//         echo "selected"; 
// }

?>

<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5"><?= $artic['title'] ?></h1>
        <p class="lead"><?= $artic['description'] ?></p>
        <div style="display: flex; justify-content: space-between;">
            <p><?= \Helpers\get_formatted_timestamp($artic['uploaded']) ?></p>
            <p><?= $artic['user_name'] ?></p>
        </div>
        <div style="display: flex; justify-content: space-between">
            <p><a class="btn btn-outline-secondary" href="<?= '/users/' . $artic['user_name'] . '/articles/' . $artic['id'] . '/edit' . $gets ?>">Изменить статью</a></p>
            <p><a class="btn btn-outline-secondary" href="<?= '/users/' . $artic['user_name'] . '/articles/' . $artic['id'] . '/delete' . $gets ?>">Удалить статью</a></p>
        </div>
    </div>
</main>

<?php require \Helpers\get_fragment_path('__comment_form') ?>
<?php $u2 = \Helpers\get_GET_params(['page', 'filter', 'ref']) ?>

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
        <?php $u1 = '/' . $artic['id'] . '/comments/' . $comm['id'] ?>
        <p>
            <a class="btn btn-primary" href="<?= $u1 . '/edit' . $u2 ?>">Исправить</a>
            <a class="btn btn-primary" href="<?= $u1 . '/delete' . $u2 ?>">Удалить</a>
        </p>
        <hr>
    <?php } ?>
</div>

<?php require \Helpers\get_fragment_path('__footer'); ?>