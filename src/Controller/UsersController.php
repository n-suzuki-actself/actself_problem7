<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;

class UsersController extends AppController{

    public $name = 'Users';
    public $autoRender = false; 
    
    public function __construct(\Cake\Network\Request $request = null, \Cake\Network\Response $response = null, $name = null, $eventManager = null, $components = null) {
        parent::__construct($request, $response, $name, $eventManager, $components);
        session_start();
        //var_dump($_SESSION['login']);
        if(isset($_SESSION['login']) != true){
            // ログインされてない
            // リダイレクト　ログイン画面へ
            return $this->redirect(['controller' => 'Logins', 'action' => 'login']);
        }
        
    }

    public function index(){
        // ユーザー一覧画面表示
        $users = TableRegistry::get('Users');
        $data = $users->getList();
        $this->set('data' , $data);
        $this->Render('/Users/index');
        
    }    
               
    public function add(){          
        // GETか？
        if($this->request->is('get')){
            // GETである
            // 新規登録画面を表示
            $this->Render('/Users/add');
        }
        else{
            // GET以外である
            // Tableクラスを呼び出して、登録処理
            $users = TableRegistry::get('Users');
            
            $mail_address  = $this->request->data('mail_address');
            $password      = $this->request->data('password');
            $name          = $this->request->data('name');
              
            $users->addRecord($mail_address , $password , $name);
            // その後、index()へリダイレクト  
            $this->redirect('/Users/index');
                
        }
            
    }
                        
    public function update(){
        // GETか？
        if($this->request->is('get')){
            // GETである
            // 更新画面を表示
            $this->Render('/Users/update');
        }
        else{
            // GET以外である
            // Tableクラスを呼び出して、更新処理
            $users = TableRegistry::get('Users');
            
            $id            = $this->request->data('id');
            $mail_address  = $this->request->data('mail_address');
            $password      = $this->request->data('password');
            $name          = $this->request->data('name');
            
            $users->updateRecord($id , $mail_address , $password , $name);
            // その後、index()へリダイレクト  
            $this->redirect('/Users/index');
                
        }
                    
    }
        
    public function delete($id){ 
        // Tableクラスを呼び出して、削除処理
        $users = TableRegistry::get('Users');             
        $users->delRecord($id);
        // その後、index()へリダイレクト
        $this->redirect('/Users/index');
        
    }
        
}
