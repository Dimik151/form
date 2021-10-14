<?php 

namespace Controllers;

require_once $base_path . 'modules\helpers.php';

class BaseController {
    public $current_user = NULL;

    protected function context_append (array &$context){
        $context['__current_user'] = $this->current_user;
    }

    protected function render (string $template, array $context){
        $this->context_append($context);
        \Helpers\render($template, $context);
    }

    function __construct() {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();
        if (isset($_SESSION['current_user'])) {
            $users = new \Models\User();
            $this->current_user = $users->get_or_404($_SESSION['current_user']);
        }else
            session_destroy();     
    }
}