<?php require \Helpers\get_fragment_path('__header') ?>
<h2>Удаление комментария</h2>

<div class="container">
    <form class="w-25" method="POST">

        <h1 class="mt-5">Удалить комментарий</h1>
        <span class="input-group-text">Имя</span>
        <p><?= $comment['user_name'] ?></p>

        <span class="input-group-text">Текст</span>
        <p><?= $comment['content'] ?></p>

        <button type="submit" class="btn btn-primary">Удалить</button>

    </form>
</div>

<?php $ret = '/' . $article . \Helpers\get_GET_params(['page', 'filter', 'ref']) ?>
<?php require \Helpers\get_fragment_path('__footer') ?>