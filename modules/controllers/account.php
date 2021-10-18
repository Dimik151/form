<?php 

namespace Controllers;

use Page403Exception;

class Account extends BaseController {
    
    private function check_user(string $username) {
        $users = new \Models\User();
        $user = $users->get_or_404($username, 'name', 'id');
        if (!($this->current_user && ($this->current_user['id'] == $user['id'] || $this->current_user['admin'])))
            throw new Page403Exception();
    }

    function profile(string $username) {
        $users = new \Models\User();
        $user = $users->get_or_404($username, 'name', 'id, name, name1, name2, email');
        $ctx = ['site_title' => 'Профиль', 'user' => $user];
        $this->render('account', $ctx);
    }

    function edit(string $username) {
        $this->check_user($username);
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $update_form = \Forms\Update::get_normalized_data($_POST);
        if (!isset($update_form['__errors'])) {
            $update_form = \Forms\Update::get_prepared_data($update_form);
            $users = new \Models\User();
            $users->update($update_form, $username, 'name');
            \Helpers\redirect('/users/' . $username . '/account/profile');
        }
        }else{
            $users = new \Models\User();
            $user = $users->get_or_404($username, 'name');
            $update_form = \Forms\Update::get_initial_data($user);
        }
        $ctx = ['form' => $update_form, 'site_title' => 'Правка профиля', 'user' => $user];
        $this->render('user_edit', $ctx);
    }

    function editpassword(string $username) {
        $this->check_user($username);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           $pass_form = \Forms\Password::get_normalized_data($_POST);
        if (!isset($pass_form['__errors'])) {
            $pass_form = \Forms\Password::get_prepared_data($pass_form);
            $users = new \Models\User();
            $users->update($pass_form, $username, 'name');
            \Helpers\redirect('/users/' . $username . '/account/profile');
        }
        }else{
            $pass_form = \Forms\Password::get_initial_data();
        }
        $ctx = ['form' => $pass_form, 'site_title' => 'Смена пароля'];
        $this->render('user_password', $ctx);
    }
    
    function delete(string $username) {
        $this->check_user($username);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $users = new \Models\User();
            $users->delete($username, 'name');
            unset ($_SESSION['current_name']);
            session_destroy();
            \Helpers\redirect('/');
        }else{
            $ctx = ['site_title' => 'Удаление пользователя'];
            $this->render('user_delete', $ctx);
        }
    }


}