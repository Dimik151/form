<?php 

namespace Forms;

class Password extends \Forms\Form {

    protected const FIELDS = [
        'password1' => ['type' => 'string', 'nosave' => TRUE],
        'password2' => ['type' => 'string', 'nosave' => TRUE]
    ];

    protected static function after_normalize_data(&$data, &$errors) {
        if ($data['password1'] != $data['password2'])
            $errors['password2'] = 'Введите в эти поля один и тот же пароль';
    }

    protected static function after_prepare_data(&$data, &$norm_data) {
        $data['password'] = password_hash($norm_data['password1'], PASSWORD_BCRYPT);
    }

}