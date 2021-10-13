<?php 

namespace Helpers {
    
    function render(string $template, array $context){
        global $base_path;
        extract($context);
        require $base_path . '\modules\templates\\' . $template . '.php';
    }

    function get_fragment_path(string $fragment) : string {
        global $base_path;
        return $base_path . '\modules\templates\\' . $fragment . '.inc.php';
    }

    function connect_to_db(){
        $conn_str = 'mysql:host=' . \Settings\DB_HOST . ';dbname=' . \Settings\DB_NAME . ';charset=utf8';
        return new \PDO($conn_str, \Settings\DB_USERNAME, \Settings\DB_PASSWORD);
    }

    function get_GET_params(array $existing_param_names, array $new_params = []) : string {
        $a = [];
        foreach ($existing_param_names as $name) 
            if (!empty($_GET[$name]))
                $a[] = $name . '=' . urldecode($_GET[$name]);
        foreach ($new_params as $name => $value)
            $a[] = $name . '=' . urlencode($value);
        $s = implode('&', $a);
        if ($s)
            $s = '?' . $s;
        return $s;
    }

    function get_formatted_timestamp (string $timestamp) : string {
        return strftime('%d.%m.%Y %H:%M:%S', strtotime($timestamp));
    }

    function redirect (string $url, int $status = 302) {
        header('Location: ' . $url, TRUE, $status);
    }

    function show_errors(string $fld_name, array $form_data) {
        if (isset($form_data['__errors'][$fld_name]))
            echo '<div><span style="color: red;">' . $form_data['__errors'][$fld_name] . '</span></div>';
    }

}
