<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class BooksTable extends Table{   
    
    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('title', 'タイトルが入力されていません');
            //->minLength('title',3,'3文字以上入力してください');
        
        return $validator;
    }
            
}