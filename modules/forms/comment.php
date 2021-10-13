<?php 

namespace Forms;

class Comment extends \Forms\Form {

    protected const FIELDS = [
        'user' => ['type' => 'integer'],
        'content' => ['type' => 'string'],
        'uploaded' => ['type' => 'timestamp']
    ];
    
}