<?php require \Helpers\get_fragment_path('__header') ?>

<div class="container w-50">
    <h2>Редактирование статьи</h2>
    <?php require \Helpers\get_fragment_path('__article_form') ?>
    <?php $ret = '/users/' . $username . \Helpers\get_GET_params(['page', 'filter']) ?>
</div>

<?php require \Helpers\get_fragment_path('__footer') ?>