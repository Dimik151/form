<form method="POST" enctype="multipart/form-data">
    <label for="picture_category">Категория</label>
    <select name="category" id="picture_category">
        <?php foreach ($categories as $category) { ?>
            <option value="<?= $category['id'] ?>"
            <?php if ($form['category'] == $category['id']) { ?> selected<?php } ?>>
            <?= $category['name'] ?>    
        </option>
        <?php } ?>
    </select>

    <label for="picture_title">Название</label>
    <input type="text" id="picture_title" name="title" value="<?= $form['title'] ?>">
    <?php \Helpers\show_errors('title', $form) ?>

    <label for="picture_description">Описание</label>
    <textarea name="description" id="picture_description" cols="30" rows="10"><?= $form['description'] ?></textarea>

    <label for="picture_file">Файл с изображением</label>
    <input type="file" id="picture_file" name="picture">
    <?php \Helpers\show_errors('picture', $form) ?>

    <input type="submit" value="Отправить">
</form>