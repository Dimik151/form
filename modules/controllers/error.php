<?php 

namespace Controllers;

class Error extends BaseController {
    function page404(){
        $this->render('404', []);
    }

    function page503($e){
        $ctx = ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()];
        $this->render('503', $ctx);
    }
}