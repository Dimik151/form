<?php http_response_code(404) ?>
<?php require \Helpers\get_fragment_path('__header') ?>
<div class="container">
    <h2>Страница не найдена</h2>
    <p>Запрошенный интернет-адрес не существует</p>
    <p><a href="/">На главную</a></p>
</div>
<?php require \Helpers\get_fragment_path('__footer') ?>