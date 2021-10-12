<?php 

$request_path = $_GET['route'];

if ($request_path && $request_path[-1] == '/')
    $request_path = substr($request_path, 0, strlen($request_path) -1);
$result = [];

if (preg_match('/^cats\/(\w+)$/', $request_path, $result) === 1){
    $ctr = new \Controllers\Articles();
    $ctr->by_cat($result[1]);
}else if (preg_match('/^users\/(\w+)$/', $request_path, $result) === 1) {
    $ctr = new \Controllers\Articles();
    $ctr->by_user($result[1]);
}else if ($request_path == 'cats') {
    $ctr = new \Controllers\Articles();
    $ctr->all_cat();
}else if (preg_match('/^(\d+)$/', $request_path, $result) === 1) {
    $index = (integer)$result[1];
    $ctr = new \Controllers\Articles();
    $ctr->item($index);
}else if ($request_path == '') {
    $ctr = new \Controllers\Articles();
    $ctr->list();
} else {
    throw new Page404Exception();
}