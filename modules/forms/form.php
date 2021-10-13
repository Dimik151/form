<?php 

namespace Forms;

class Form {
    protected const FIELDS = [];

    private static function get_initial_value($fld_name, $fld_params, $initial = []) {
        if (isset($initial[$fld_name]))
            $val = $initial[$fld_name];
        else if (isset($fld_params['initial']))
            $val = $fld_params['initial'];
        else 
            $val = '';
        if ($fld_params['type'] == 'timestamp') {
            if (gettype($val) == 'integer')
                $val = strftime('%Y-%m-%d %H:%M:%S', $val);
            $val = explode(' ', $val);
        }
        return $val;
    }

    protected static function after_initialize_data(&$data) {

    }

    public static function get_initial_data($initial = []) {
        $data = [];
        foreach (static::FIELDS as $fld_name => $fld_params)
            $data[$fld_name] = self::get_initial_value($fld_name, $fld_params, $initial);
        static::after_initialize_data($data);
        return $data;
    }

    protected static function after_normalize_data(&$data, &$errors) {

    }

    public static function get_normalized_data ($form_data) {
        $data = [];
        $errors = [];
        foreach (static::FIELDS as $fld_name => $fld_params) {
            $fld_type = (isset($fld_params['type'])) ? $fld_params['type'] : 'string';
            if ($fld_type == 'boolean')
                $data[$fld_name] = !empty($form_data[$fld_name]);
            else {
                if (empty($form_data[$fld_name])) {
                    $data[$fld_name] = self::get_initial_value($fld_name, $fld_params);
                    if (!isset($fld_params['optional']))
                        $errors[$fld_name] = 'Это поле обязательно к заполнению';
                } else {
                    $fld_value = $form_data[$fld_name];
                    switch ($fld_type) {
                        case 'integer' :
                            $v = filter_var($fld_value, FILTER_SANITIZE_NUMBER_INT);
                            if ($v)
                                $data[$fld_name] = $v;
                            else 
                                $errors[$fld_name] = 'Введите целое число';
                            break;
                        case 'float' :
                            $v = filter_var($fld_value, FILTER_SANITIZE_NUMBER_FLOAT, ['flags' => FILTER_FLAG_ALLOW_FRACTION]);
                            if ($v)
                                $data[$fld_name] = $v;
                            else 
                                $errors[$fld_name] = 'Введите вещественное число';
                            break;
                        case 'timestamp' :
                            $v = strtotime(implode(' ', $fld_value));
                            if ($v)
                                $data[$fld_name] = $fld_value;
                            else 
                                $errors[$fld_name] = 'Введите дату и время';
                            break;
                        case 'email' :
                            $v = filter_var($fld_value, FILTER_SANITIZE_EMAIL);
                            if ($v)
                                $data[$fld_name] = $v;
                            else 
                                $errors[$fld_name] = 'Введите адрес электронной почты';
                            break;
                        default :
                            $data[$fld_name] = filter_var($fld_value, FILTER_SANITIZE_STRING);
                    }
                }
            }
        }
        static::after_normalize_data($data, $errors);
        if ($errors)
            $data['__errors'] = $errors;
        return $data;  
    }

    protected static function after_prepare_data (&$data, &$norm_data) {

    }

    public static function get_prepared_data($norm_data) {
        $data = [];
        foreach (static::FIELDS as $fld_name => $fld_params) {
            if (!isset($fld_params['nosave']) && isset($norm_data[$fld_name])) {
                $val = $norm_data[$fld_name];
                if ($fld_params['type'] == 'timestamp')
                    $data[$fld_name] = implode(' ', $val);
                else 
                    $data[$fld_name] = $val;
            }
        }
        static::after_prepare_data($data, $norm_data);
        return $data;
    }
}