<?php require \Helpers\get_fragment_path('__header') ?>

<div class="container">
    <h2>Удаление пользователя</h2>
    <form action="" method="POST">
        <input type="hidden" name="__token" value="<?= $__token ?>">
        <input type="submit" value="Удалить">
    </form>
</div>

<?php require \Helpers\get_fragment_path('__footer') ?>