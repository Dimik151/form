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