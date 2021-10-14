<div class="container">
<form class="w-25" method="POST">

<h1 class="mt-5">Отправить комментарий</h1>
<span class="input-group-text">Имя</span>
<select class="form-select" id="validationCustom04" name="user" required>
    <?php foreach ($users as $user) { ?>
        <option value="<?= $user['id'] ?>"
        <?php if ($form['user'] == $user['id']) { ?>
        selected<?php } ?>>
            <?= $user['name'] ?>
    </option>
    <?php } ?>
</select>

<span class="input-group-text">Текст</span>
<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"><?= $form['content'] ?></textarea>
<?php \Helpers\show_errors('content', $form) ?>

<button type="submit" class="btn btn-primary">Отправить</button>

</form>
</div>