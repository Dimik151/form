<?php 

namespace Forms;

class Picture extends \Forms\Form {
    protected const FIELDS = [
        'title' => ['type' => 'string'],
        'description' => ['type' => 'string'],
        'category' => ['type' => 'integer']
    ];

    protected const IS_PICTURE_OPTIONAL = TRUE;

    private const EXTENSIONS = ['gif', 'jpg', 'jpeg', 'jpe', 'png', 'svg'];

    protected static function after_normalize_data(&$data, &$errors) {
        $file = $_FILES['picture'];
        $error = $file['error'];
        if ($error == UPLOAD_ERR_NO_FILE) {
            if (!static::IS_PICTURE_OPTIONAL) 
                $errors['picture'] = 'Укажите файл с изображением';
        }else if (!in_array(pathinfo($file['name'], PATHINFO_EXTENSION), self::EXTENSIONS))
            $errors['picture'] = 'Укажите файл с изображением в формате GIF, JPEG, PNG или SVG';
        else if ($error == UPLOAD_ERR_OK) {}
        else if ($error == UPLOAD_ERR_INI_SIZE || $error === UPLOAD_ERR_FORM_SIZE)
            $errors['picture'] = 'Файл должен быть не более 2 Мб';
        else 
            $errors['picture'] = 'Файл не был отправлен';
    }
}