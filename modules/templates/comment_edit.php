<?php require \Helpers\get_fragment_path('__header') ?>

<div class="container">
    <form class="w-25" method="POST">
        <input type="hidden" name="__token" value="<?= $form['__token'] ?>">
        <h1 class="mt-5">Правка комментарий</h1>
        <span class="input-group-text">Имя</span>
        <select class="form-select" id="validationCustom04" name="user" required>
            <?php foreach ($users as $user) { ?>
                <option value="<?= $user['id'] ?>"
                    <?php if ($form['user'] == $user['id']) { ?> selected<?php } ?>> <?= $user['name'] ?>
                </option>
            <?php } ?>
        </select>
        <span class="input-group-text">Текст</span>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"><?= $form['content'] ?></textarea>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
</div>

<?php $ret = '/' . $article . \Helpers\get_GET_params(['page', 'filter', 'ref']) ?>

<?php require \Helpers\get_fragment_path('__footer') ?>