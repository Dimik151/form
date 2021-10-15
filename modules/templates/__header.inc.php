<!DOCTYPE html>
<html lang="ru" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <title> <?= ((isset($site_title)) ? $site_title . ' :: ' : '') ?> 
            <?= \Settings\SITE_NAME ?> </title>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
    </style>
</head>

<body class="d-flex flex-column h-100">
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-secondary">Главная</a></li>
                <li><a href="/cats/" class="nav-link px-2 text-secondary">Категории</a></li>
            </ul>
            <?php require \Helpers\get_fragment_path('__filter_form') ?>
            <?php 
                if ($__current_user['name1'] && $__current_user['name2'])
                    $user_name = $__current_user['name1'] . ' ' . $__current_user['name2'];
                else if ($__current_user['name1'])
                    $user_name = $__current_user['name1'];
                else 
                    $user_name = $__current_user['name'];
            ?>
            <div class="text-end">
                <?php if ($__current_user) { ?>
                    <a class="btn btn-outline-light me-2" href="/users/<?= $__current_user['name'] ?>"><?= $user_name ?></a>
                    <a class="btn btn-outline-light me-2" href="/users/<?= $__current_user['name'] ?>/account/delete">Удалить пользователя</a>
                    <a class="btn btn-warning" href="/logout">Выйти</a>
                <?php } else { ?>
                    <a class="btn btn-outline-light me-2" href="/login">Войти</a>
                    <a class="btn btn-warning" href="/register">Регистрация</a>
                <?php } ?>
            </div>
        </div>
    </div>
</header>