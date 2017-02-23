<?php
namespace App\Controller;
//use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

class LoginsController extends AppController{
    
    public $name = 'Logins';
    public $autoRender = false;
    
    public function login(){
        // GETか？
        if($this->request->is('get')){
            // ログイン画面表示
            $this->Render('/Logins/login');
          
        }
        else{
            // POSTで来たらバリデーションスタート
            $validator = new Validator();            
            $validator                   
                ->requirePresence('mail_address')
                ->notEmpty('mail_address' , 'メールアドレス又はパスワードが入力されていません') 
                // メールアドレス形式かチェック
                ->add('mail_address','validEmail', [
                    'rule' => 'email',
                    'last' => true,
                    'message' => 'メールアドレスが不当です',                   
                ])
                ->requirePresence('password')
                ->notEmpty('password' , 'メールアドレス又はパスワードが入力されていません');
                
            $errors = $validator->errors($this->request->data);
            // $errorsに値が入っている
            if(! empty($errors)){
                // メールアドレスが未入力の場合
                if(isset($errors['mail_address']['_empty'])){
                   $error_messsage = $errors['mail_address']['_empty'];
                }
                // メールアドレスが不当の場合
                if(isset($errors['mail_address']['validEmail'])){
                    $error_messsage = $errors['mail_address']['validEmail'];
                }
                // パスワードが未入力の場合
                if(isset($errors['password']['_empty'])){
                    $error_messsage = $errors['password']['_empty'];
                }
                // エラーメッセージをフォームに表示
                $this->set('error_messsage', $error_messsage);
                $this->Render('/Logins/login');
                
            }
            else{ 
                // バリデーションOK
                session_start();
                // セッションスタートして、書籍一覧へ
                $_SESSION['login'] = true;
                $this->redirect('/Books/index');
            }
            

        }
        
    }
    
}

 
