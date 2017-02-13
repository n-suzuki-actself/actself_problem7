<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;

$validator = new Validator();

class LoginsTable extends Table{
    //Table
    public function validationDefault(Validator $validator)
    {
        $validator
            //notEmptyの記述。第二引数はメッセージ
            ->notEmpty('id', 'メールアドレスを入力してください')
            //メール形式のチェック
            ->add('id', 'validFormat', [
                'rule' => 'alphaNumeric',
                'message' => '英数字でなければなりません'
            ])
        ;
        return $validator;
    }
    
}
