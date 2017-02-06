<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;

class BooksController extends AppController{

    public $name = 'Books';
    public $autoRender = false;
    
    public function __construct(\Cake\Network\Request $request = null, \Cake\Network\Response $response = null, $name = null, $eventManager = null, $components = null) {
        parent::__construct($request, $response, $name, $eventManager, $components);
        session_start();
        //$this->request->session()->read('login');
        if(isset($_SESSION['login']) != true){
            // ログインされてない
            // リダイレクト　ログイン画面へ
            return $this->redirect(['controller' => 'Logins', 'action' => 'login']);
        }
        
    }
           
    public function index(){
        // 書籍一覧画面表示
        $books = TableRegistry::get('Books');
        $data = $books->getList();
        $this->set('data' , $data);
        $this->Render('/Books/index');
        
    }
    
                       
    public function delete($id){  
        // GETか？
        if($this->request->is('post')){
            echo '予期しないフロー';
        }
        else{                
            // GET以外である
            // Tableクラスを呼び出して、削除処理
            $books = TableRegistry::get('Books');
            $books->delRecord($id);
            // その後、index()へリダイレクト
            $this->redirect('/Books/index');
            
        }           
    }
        
    public function add(){  
        //$str = time();
        // GETか？
        if($this->request->is('get')){
            // GETである
            // 新規登録画面を表示
            $str = sha1(time());
            $_SESSION['time'] = $str;
            //var_dump($str);
            $this->set('str' , $str);
            $this->Render('/Books/add');
            
        }
        
        elseif($_SESSION['time'] != $this->request->data('time')) {
            
            echo '危険なアクセス';
            
            var_dump($this->request->data('time'));
            var_dump($_SESSION['time']);
            
        }
        
        else{         
            // GET以外である
            // Tableクラスを呼び出して、登録処理
            $books = TableRegistry::get('Books');
            
            $title       = $this->request->data('title');
            $author      = $this->request->data('author');
            $released_in = $this->request->data('released_in');
               
            $books->addRecord($title , $author , $released_in);
            // その後、index()へリダイレクト  
            $this->redirect('/Books/index');
                
        }
            
    }     
    
    public function update(){
        // GETか？
        if($this->request->is('get')){
            // GETである
            // 新規更新画面を表示
            $this->Render('/Books/update');
        }
        else{
            // GET以外である
            // Tableクラスを呼び出して、更新処理
            $books = TableRegistry::get('Books');
            
            $id          = $this->request->data('id');
            $title       = $this->request->data('title');
            $author      = $this->request->data('author');
            $released_in = $this->request->data('released_in');
              
            $books->updateRecord($id , $title , $author , $released_in);
            // その後、index()へリダイレクト  
            $this->redirect('/Books/index');
                
        }
                    
    }     
        
}