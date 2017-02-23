<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class BooksTable extends Table{   
    public function validationDefault(Validator $validator) {
        //parent::validationDefault($validator);
        return $validator;
    }
            
}