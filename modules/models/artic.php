<?php 

namespace Models;

class Artic extends \Models\Model {

    protected const TABLE_NAME = 'articles';
    protected const DEFAULT_ORDER = 'uploaded DESC';
    protected const RELATIONS = 
        ['categories' => ['external' => 'category',
                        'primary' => 'id'],
        'users' => ['external' => 'user',
                    'primary' => 'id']
        ];
}