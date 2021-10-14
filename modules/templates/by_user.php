<?php require \Helpers\get_fragment_path('__header'); ?>
<?php $gets = \Helpers\get_GET_params(['page', 'filter'], ['ref' => 'users']) ?>

<main>
    <div class="container">
        <h2>Пользователь: <?= $user['name'] ?></h2>
        <div class="album py-5 bg-light">
            <div class="container">
                <?php foreach ($artic as $arst) { ?>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <a href="/<?= $arst['id'], $gets ?>">
                            <div class="col">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <p class="card-text"><?= $arst['title'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
                <div>
                    <p><a class="btn btn-outline-secondary" href="<?= '/users/' . $user['name'] . '/articles/add' . $gets ?>">Добавить статью</a></p>
                </div>
                <?php require \Helpers\get_fragment_path('__paginator') ?>
            </div>

        </div>
    </div>
</main>

<?php require \Helpers\get_fragment_path('__footer'); ?>



