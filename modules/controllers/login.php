<?php 

namespace Controllers;

class Login extends BaseController {

    function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login_form = \Forms\Login::get_normalized_data($_POST);
            if (!isset($login_form['__errors'])) {
                $login_form = \Forms\Login::get_prepared_data($login_form);
                $user_id = \Forms\Login::verify_user($login_form);
                if ($user_id) {
                    session_start();
                    $_SESSION['current_user'] = $user_id;
                    \Helpers\redirect('/users/' . $login_form['name']);
                }
            }
        }else 
            $login_form = \Forms\Login::get_initial_data();
        $ctx = ['form' => $login_form, 'site_title' => 'Вход'];
        $this->render('login', $ctx);
    }

    function logout() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            unset($_SESSION['current_user']);
            session_destroy();
            \Helpers\redirect('/');
        }else {
            $ctx = ['site_title' => 'Выход'];
            $this->render('logout', $ctx);
        }
    }
}