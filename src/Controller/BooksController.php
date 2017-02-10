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
        // GETか？
        if($this->request->is('get')){
            // GETである
            // CSRF対策 ワンタイムトークン発行
            // セッションに記録
            // 新規登録画面を表示
            $str = sha1(time());
            $_SESSION['one_time_token'] = $str;
            $this->set('str' , $str);
            $this->Render('/Books/add');
            
        }// ワンタイムトークンが一致するか      
        elseif($_SESSION['one_time_token'] != $this->request->data('one_time_token')) {
            
            echo '危険なアクセス';
            
           // var_dump($this->request->data('one_time_token'));
            //var_dump($_SESSION['one_time_token']);
            
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
            $str = sha1(time());
            // CSRF対策 ワンタイムトークン発行
            // セッションに記録
            $_SESSION['one_time_token'] = $str;
            $this->set('str' , $str);
            // 新規更新画面を表示
            $this->Render('/Books/update');
            
        }// ワンタイムトークンが一致するか   
        elseif($_SESSION['one_time_token'] != $this->request->data('one_time_token')) {
            
            echo '危険なアクセス';
          
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

    public function search(){
        // GETか？
        if($this->request->is('get')){
            $str = sha1(time());
            // CSRF対策 ワンタイムトークン発行
            // セッションに記録
            $_SESSION['one_time_token'] = $str;
            $this->set('str' , $str);
            $this->Render('/Books/search'); 
        }
        else{
            // GET以外である
            // Tableクラスを呼び出して、タイトルのキーワード検索
            $books = TableRegistry::get('Books');
            
            $keyword = $this->request->data('keyword');
            
            $data = $books->searchRecords($keyword);
            // その後、キーワード検索結果を表示
            $this->set('data' , $data);
            $this->Render('/Books/index');
       
        }   
        
    }
    
}