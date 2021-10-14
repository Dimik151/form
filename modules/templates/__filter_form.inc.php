<?php 
    if (isset($_GET['filter']) && !empty($_GET['filter']))
        $f = $_GET['filter'];
    else
        $f = '';
?>

<form style="display: flex" method="GET">
    <input type="search" class="form-control form-control-dark" placeholder="Поиск..." aria-label="Search" name='filter' value="<?= $f ?>">
    <input type="submit" class="btn btn-outline-light me-2" value="Поиск">
</form>