<form method="POST" enctype="multipart/form-data">

    <label for="picture_category">Категория</label>

    <select name="category" class="form-select" aria-label="Default select example">
        <?php foreach ($categories as $category) { ?>
            <option value="<?= $category['id'] ?>"
                <?php if ($form['category'] == $category['id']) { ?> selected<?php } ?>>
                <?= $category['name'] ?>    
            </option>
        <?php } ?>
    </select>


    <label class="form-label">Название статьи</label>
    <input type="text" class="form-control" name="title" value="<?= $form['title'] ?>">
    <?php \Helpers\show_errors('title', $form) ?>

    
    <label class="form-label">Описание статьи</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"><?= $form['description'] ?></textarea>
    <?php \Helpers\show_errors('description', $form) ?>

    <div class="input-group mb-3">
        <input type="file" class="form-control" name="picture">
        <?php \Helpers\show_errors('picture', $form) ?>
    </div>

    <input class="btn btn-outline-secondary" type="submit" value="Отправить">
    
</form>


