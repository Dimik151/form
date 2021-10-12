<?php 

namespace Models;

class Comment extends \Models\Model {
    protected const TABLE_NAME = 'comments';
    protected const DEFAULT_ORDER = 'uploaded DESC';
    protected const RELATIONS =
        ['users' => ['external' => 'user', 'primary' => 'id']];
}