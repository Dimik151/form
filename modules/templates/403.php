<?php http_response_code(403) ?>
<?php require \Helpers\get_fragment_path('__header') ?>

<div class="container">
    <h2>Доступ запрещен</h2>
    <p>У вас нет прав на доступ к этой странице или выполнения этой операции.</p>
    <p><a class="btn btn-outline-secondary" href="/">На главную</a></p>
</div>

<?php require \Helpers\get_fragment_path('__footer') ?>