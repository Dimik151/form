<?php require \Helpers\get_fragment_path('__header') ?>

<div class="container">
    <h2>Регистрация</h2>
    <form class="bigform w-25" method="post" >
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Логин</span>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" name="name" value="<?php echo $form['name'] ?>">
        </div>
        <?php \Helpers\show_errors('name', $form) ?>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Пароль</span>
            <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="password1">
        </div>
        <?php \Helpers\show_errors('password1', $form) ?>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Подтверждение пароля</span>
            <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="password2">
        </div>
        <?php \Helpers\show_errors('password2', $form) ?>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Email address</span>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $form['email'] ?>">
        </div>
        <?php \Helpers\show_errors('email', $form) ?>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Имя</span>
            <input type="text" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" name="name1" value="<?= $form['name1'] ?>">
        </div>
        <?php \Helpers\show_errors('name1', $form) ?>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Фамилия</span>
            <input type="text" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" name="name2" value="<?= $form['name2'] ?>">
        </div>
        <?php \Helpers\show_errors('name2', $form) ?>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="emailme" value="1" <?php if ($form['emailme']) echo 'checked' ?>>
            <label class="form-check-label" for="exampleCheck1">Получать оповещения о новых комментариях?</label>
        </div>
        <input type="submit" class="btn btn-primary" value="Регистрация">
    </form>
</div>

<?php require \Helpers\get_fragment_path('__footer') ?>