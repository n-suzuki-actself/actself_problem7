<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

class LoginsController extends AppController{

    public $name = 'Logins';
    public $autoRender = false;
    
    public function login(){
        
        if($this->request->is('get')){
            // GETである
            // ログイン画面を表示
            $this->Render('/Logins/login');
            
        }
        else{
            // 入力されたメールアドレスが一致するか確認        
            $users = TableRegistry::get('Users');
            $mail_address = $this->request->data('mail_address');           
            $rows = $users->getRecord($mail_address , "mail_address");
            
            if(! isset($rows['mail_address'])){
                echo "メールアドレスが登録されていません";
                // ログイン画面へ
                // エラー文言表示
                $this->Render('/Logins/login');
                
            }
            else{
                // 入力されたパスワードが一致するか確認
                $password = $this->request->data('password');
                $salt = $rows['created'];
                $password_with_salt = sha1($password . $salt);
                $db_password = $rows['password'];
                
                if($password_with_salt != $db_password){
                    //ログイン画面へ
                    //エラー文言表示
                    echo 'パスワードが不当です';
                    $this->Render('/Logins/login');
                }
                else{
                    session_start();
                    //入力値がDBと一致
                    // セッションに記録
                    $_SESSION['login'] = true;
                    // リダイレクト　書籍一覧画面へ
                    $this->redirect(['controller'=>'Books','action' => 'index']);
                }                
        
            }
            
        }
        
    }

}
    
