<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker; 

class BooksTable extends Table{   
    
    public function validationDefault(Validator $validator) {
        
        $validator
            ->notEmpty('title');
        $validator
            ->notEmpty('author');
        $validator
            ->notEmpty('released_in')
            ->numeric('released_in')
            ->maxLength('released_in',4);
                    
        return $validator;
        
    }
       
//    public function buildRules(RulesChecker $rules) {
//        
//        $rules
//            ->notEmpty('title');
//        $rules
//            ->notEmpty('author');
//        $rules
//            ->notEmpty('released_in')
//            ->numeric('released_in')
//            ->maxLength('released_in',4);
//        
//        return $rules;
//        
//    }
}