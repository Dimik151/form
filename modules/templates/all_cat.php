<?php require \Helpers\get_fragment_path('__header'); ?>

<main>
    <div class="container">
        <div class="album py-5 bg-light">
            <div class="container">
                <?php foreach ($cats as $art) { ?>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <a href="/cats/<?= $art['slug'] ?>">
                            <div class="col">
                                <div class="card shadow-sm">
                                    <div class="card-body" style="display: flex; justify-content: space-between">
                                        <p class="card-text"><?= $art['cat_name'] ?></p>
                                        <p class="card-text"><?= $art['pic_cnt'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>

<?php require \Helpers\get_fragment_path('__footer'); ?>