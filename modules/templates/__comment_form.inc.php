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

<!-- <input type="text" aria-label="First name" class="form-control" placeholder="Имя"> -->

<!-- <span class="input-group-text">E-mail</span>
<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"> -->

<span class="input-group-text">Текст</span>
<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"><?= $form['content'] ?></textarea>

<?php \Helpers\show_errors('content', $form) ?>



<!-- <span class="input-group-text">Прикрепите изображение</span>
<input class="form-control" type="file" id="formFile">

<button type="submit" class="btn btn-primary">Предварительный просмотр</button> -->

<button type="submit" class="btn btn-primary">Отправить</button>

</form>
</div>