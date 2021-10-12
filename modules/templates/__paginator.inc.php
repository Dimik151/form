<?php if ($paginator->page_count > 1) { ?>
<nav aria-label="...">
  <ul class="pagination">
      <?php foreach ($paginator as $number => $url) { ?>
        <?php if ($paginator->current_page == $number) { ?>
            <li class="page-item active" aria-current="page">
                <a class="page-link" href="#"><?= $number ?></a>
            </li>
        <?php } else { ?>
            <li class="page-item"><a class="page-link" href="<?= $url ?>"><?= $number ?></a></li>
        <?php } ?>
<?php } ?>
  </ul>
</nav>

<?php } ?>



