<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

class LoginsController extends AppController{

    public $name = 'Logins';
    public $autoRender = false;
    
    public function login(){
        session_start();
        if($this->request->is('get')){
            // GETである
            // CSRF対策 ワンタイムトークン発行
            // セッションに記録
            $str = sha1(time());
            $_SESSION['one_time_token'] = $str;
            $this->set('str' , $str);           
            // ログイン画面を表示
            $this->Render('/Logins/login');
            
        }// ワンタイムトークンが一致するか
        elseif($_SESSION['one_time_token'] != $this->request->data('one_time_token')){
            
            echo '危険なアクセス';
            
        }
        else{
            // 入力されたメールアドレスが一致するか確認        
            $users = TableRegistry::get('Users');
            $mail_address = $this->request->data('mail_address');           
            $row = $users->getRecord($mail_address , "mail_address");
            
            if(! isset($row)){
                echo "メールアドレス又はパスワードが合っていません";
                // ログイン画面へ
                // エラー文言表示
                $this->Render('/Logins/login');
                
            }
            else{
                // 入力されたパスワードが一致するか確認
                $password = $this->request->data('password');
                $salt = $row['created'];
                $password_with_salt = sha1($password . $salt);
                $db_password = $row['password'];
                
                if($password_with_salt != $db_password){
                    //ログイン画面へ
                    //エラー文言表示
                    echo 'メールアドレス又はパスワードが合っていません';
                    $this->Render('/Logins/login');
                }
                else{
                    //session_start();
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
    
