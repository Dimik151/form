<?php require \Helpers\get_fragment_path('__header') ?>

<div class="container">
    <h2>Правка профиля</h2>
    <form class="bigform w-25" method="post" >
    <input type="hidden" name="__token" value="<?= $form['__token'] ?>">
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Email address</span>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?=$user['email'] ?>">
        </div>
        <?php \Helpers\show_errors('email', $form) ?>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Имя</span>
            <input type="text" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" name="name1" value="<?= $user['name1'] ?>">
        </div>
        <?php \Helpers\show_errors('name1', $form) ?>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Фамилия</span>
            <input type="text" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" name="name2" value="<?= $user['name2'] ?>">
        </div>
        <?php \Helpers\show_errors('name2', $form) ?>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="emailme" value="1" <?php if ($user['emailme']) echo 'checked' ?>>
            <label class="form-check-label" for="exampleCheck1">Получать оповещения о новых комментариях?</label>
        </div>
        <input type="submit" class="btn btn-primary" value="Изменить">
    </form>
</div>

<?php require \Helpers\get_fragment_path('__footer') ?>