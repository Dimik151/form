<?php require \Helpers\get_fragment_path('__header'); ?>
<?php $gets = \Helpers\get_GET_params(['page', 'filter'], ['ref' => 'index']) ?>

<main>
    <div class="album py-5 bg-light">
        <div class="container" style="display: flex; justify-content: center; margin-bottom: 45px;">
            <ul class="nav nav-pills">
                <?php foreach ($cats as $cat) { ?> 
                    <li class="nav-item" style="padding: 10px;"><a href="/cats/<?= $cat['slug'] ?>" class="nav-link active" aria-current="page"><?= $cat['name'] ?></a></li>
                <? } ?>
            </ul>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($artic as $art) { ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em"><p><?= $art['title'] ?></p></text></svg>
                            <div class="card-body">
                                <p class="card-text"><?= $art['text'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="/<?= $art['id'] ?>?ref=index"><button type="button" class="btn btn-sm btn-outline-secondary">Просмотр</button></a>
                                    </div>
                                    <a href="cats/<?= $art['slug'] ?>"><small class="text-muted"><?= $art['cat_name'] ?></small></a>
                                    <a href="users/<?= $art['user_name'] ?>"><small class="text-muted"><?= $art['user_name'] ?></small></a>
                                    <small class="text-muted"><?= \Helpers\get_formatted_timestamp($art['uploaded']); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php require \Helpers\get_fragment_path('__paginator') ?>
        </div>
    </div>
</main>

<?php require \Helpers\get_fragment_path('__footer'); ?>
