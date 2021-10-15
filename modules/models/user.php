<?php 

namespace Models;

class User extends \Models\Model {
    protected const TABLE_NAME = 'users';
    protected const DEFAULT_ORDER = 'name';

    protected function before_delete($value, $key_field = 'id') {
        if ($key_field != 'id') {
            $users = new \Models\User();
            $user = $users->get($value, $key_field, 'id');
            $value = $user['id'];
        }
        $articles = new \Models\Artic();
        $articles2 = new \Models\Artic();
        $articles->select('id', NULL, 'user = ?', [$value]);
        foreach ($articles as $artic)
            $articles2->delete($articles['id']);
    }
}