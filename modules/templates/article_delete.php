<?php require \Helpers\get_fragment_path('__header') ?>

<div class="container w-50">
    <h2>Удаление статьи</h2>
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5"><?= $artic['title'] ?></h1>
            <p class="lead"><?= $artic['description'] ?></p>
            <div style="display: flex; justify-content: space-between;">
                <p><?= \Helpers\get_formatted_timestamp($artic['uploaded']) ?></p>
                <p><?= $artic['user_name'] ?></p>
            </div>
        </div>
    </main>
    <form method="POST">
        <input class="btn btn-outline-secondary" type="submit" value="Удалить">
    </form>
</div>

<?php require \Helpers\get_fragment_path('__footer') ?>