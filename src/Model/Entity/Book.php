<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
//use Cake\Datasource\ConnectionManager;

class Book extends Entity{
    protected $_accessible = [
    '*'  => true,
    'id' => false
        
    ];
}