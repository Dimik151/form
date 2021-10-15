<div class="container">
    <form class="w-25" method="POST">
        <h1 class="mt-5">Отправить комментарий</h1>
        <span class="input-group-text">Текст</span>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"><?= $form['content'] ?></textarea>
        <?php \Helpers\show_errors('content', $form) ?>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>