<?php 

$base_path = __DIR__ . '\\';
require_once $base_path . 'modules\settings.php';

function my_autoloader(string $class_name) {
    global $base_path;
    require_once $base_path . 'modules\\' . $class_name . '.php';
}

spl_autoload_register('my_autoloader');

class Page404Exception extends Exception {}
class Page403Exception extends Exception {}

function exception_handler($e) {
    $ctr = new \Controllers\Error();
    if($e instanceof Page404Exception)
        $ctr->page404();
    else if ($e instanceof Page403Exception)
        $ctr->page403();
    else
        $ctr->page503($e);
}

set_exception_handler('exception_handler');

require_once $base_path . 'modules\router.php';
