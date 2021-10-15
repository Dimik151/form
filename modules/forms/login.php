<?php 

namespace Forms;



class Login extends \Forms\Form {
    protected const FIELDS = [
        'name' => ['type' => 'string'],
        'password' => ['type' => 'string']
    ];

    static function verify_user(&$data) {
        $errors = [];
        $users = new \Models\User();
        $user = $users->get($data['name'], 'name', 'id, password, active');
        if (!$user)
            $errors['name'] = 'Неверное имя пользователя';
        else {
            if (!$user['active'])
                $erros['name'] = 'Этот пользователь неактивен';
            else {
                if (!password_verify($data['password'], $user['password']))
                    $errors['password'] = 'Неверный пароль';
                else 
                    return $user['id'];
            }
        }
        $data['__errors'] = $errors;
        return FALSE;
    }
}