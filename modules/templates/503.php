<?php http_response_code(404) ?>
<?php require \Helpers\get_fragment_path('__header') ?>
<div class="container">
    <h2>Внутренняя ошибка сервера</h2>
    <pre>
        <?= $message ?>
        <?= $flie, ', line ', $line ?>
    </pre>
    <p><a href="/">На главную</a></p>
</div>
<?php require \Helpers\get_fragment_path('__footer') ?>