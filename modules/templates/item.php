<?php require \Helpers\get_fragment_path('__header'); ?>

<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5"><?= $artic['title'] ?></h1>
    <p class="lead"><?= $artic['description'] ?></p>
    <p><?= $artic['user_name'] . ' | ' . \Helpers\get_formatted_timestamp($artic['uploaded']) ?></p>
  </div>
</main>

<div class="container">
<form class="w-25">

<h1 class="mt-5">Отправить комментарий</h1>
<span class="input-group-text">Имя</span>
<input type="text" aria-label="First name" class="form-control" placeholder="Имя">

<span class="input-group-text">E-mail</span>
<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">

<span class="input-group-text">Текст</span>
<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

<span class="input-group-text">Прикрепите изображение</span>
<input class="form-control" type="file" id="formFile">

<button type="submit" class="btn btn-primary">Предварительный просмотр</button>
<button type="submit" class="btn btn-primary">Отправить</button>

</form>
</div>

<div class="container">
<div class="w-25">
    <h1 class="mt-5">Комментарии</h1>
    <span class="input-group-text">Упорядочить</span>
    <select class="form-select" aria-label="Default select example">
        <option selected>По дате добавления</option>
        <option value="1">По имени</option>
        <option value="2">По E-mail</option>
    </select>
    <input class="btn btn-primary" type="button" value="Показать">
    </div>
    <?php foreach ($comment as $comm) { ?>
    <h3 class="mt-3"><?= $comm['user_name'] ?></h3>
    <p class="lead"><?= $comm['content'] ?></p>
    <p><?= \Helpers\get_formatted_timestamp($comm['uploaded']) ?></p>
    <hr>
    <?php } ?>


</div>

<?php require \Helpers\get_fragment_path('__footer'); ?>