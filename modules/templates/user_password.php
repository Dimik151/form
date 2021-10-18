<?php require \Helpers\get_fragment_path('__header') ?>

<div class="container">
    <h2>Смена пароля</h2>
    <form class="bigform w-25" method="post" >
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Новый Пароль</span>
            <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="password1">
        </div>
        <?php \Helpers\show_errors('password1', $form) ?>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Подтверждение пароля</span>
            <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="password2">
        </div>
        <?php \Helpers\show_errors('password2', $form) ?>
        <input type="submit" class="btn btn-primary" value="Сменить пароль">
    </form>
</div>

<?php require \Helpers\get_fragment_path('__footer') ?>