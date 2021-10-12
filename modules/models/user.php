<?php 

namespace Models;

class User extends \Models\Model {
    protected const TABLE_NAME = 'users';
    protected const DEFAULT_ORDER = 'name';
}