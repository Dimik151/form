<?php require \Helpers\get_fragment_path('__header'); ?>
<?php $gets = \Helpers\get_GET_params(['page', 'filter'], ['ref' => 'cat']) ?>
<main>
<div class="container">
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
    <?php require \Helpers\get_fragment_path('__paginator') ?>
</div>
</div>
</main>

<?php require \Helpers\get_fragment_path('__footer'); ?>
