<?php 

namespace Controllers;

require_once $base_path . 'modules\helpers.php';

class BaseController {
    protected function context_append (array &$context){

    }

    protected function render (string $template, array $context){
        $this->context_append($context);
        \Helpers\render($template, $context);
    }
}