<?php 

namespace Forms;

class Update extends \Forms\Form {

    protected const FIELDS = [
        'email' => ['type' => 'email'],
        'name1' => ['type' => 'string'],
        'name2' => ['type' => 'string'],
        'emailme' => ['type' => 'boolean', 'initial' => TRUE]
    ];

}