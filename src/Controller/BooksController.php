<?php

namespace App\Controller;

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
        $sort = $this->request->query('sort');
        if(! $sort){
            $data = $this->Books->find('all', ['order' => ['created' => 'DESC']]);
            $this->set('data' , $data);
            $this->set('sort',"<a href='/cakephp/books/index?sort=rating'>書籍評価順</a>");
            $this->Render('/Books/index');
            
        }elseif($sort == 'rating'){
            $data = $this->Books->find('all', ['order' => ['average_score' => 'DESC']]);
            $this->set('data' , $data);
            $this->set('sort',"<a href='/cakephp/books/index'>書籍新規順</a>");
            $this->Render('/Books/index');
        
        }
    }
    
    public function indexByAverage(){
        // 書籍評価の高い順に並び替えて一覧表示する
        $books = TableRegistry::get('Books');
        $column_name = "average_score";
        $data = $books->getList($column_name);
        $this->set('data' , $data);       
        $this->Render('/Books/index');
        
    }
                       
    public function delete($id){  

        if($this->request->is('get')){
            $entity = $this->Books->get($id);
            $this->Books->delete($entity);
            // その後、index()へリダイレクト
            $this->redirect('/Books/index');
            
        }           
    }    
    
        public function add(){  
        if($this->request->is('post')){
            $book_data = $this->Books->newEntity($this->request->data);
            $this->Books->save($book_data);            
            // その後、index()へリダイレクト  
            $this->redirect('/Books/index');
                
        }
        else{
            $this->set('entity' , $this->Books->newEntity());
            $this->Render('/Books/add');
        }
            
    }
    
    public function update($id){
       
        if($this->request->is('get')){                       
            // 更新画面を表示
            $book = $this->Books->get($id);            
            $this->set('entity' , $book);
            $this->Render('/Books/update');
        }
        else{
            $entity = $this->Books->get($this->request->data['id']);  
            
            //$entity->title       = $this->Books->get($this->request->data['title']);
            $entity->title       = $this->request->data['title'];
            //$entity->author      = $this->Books->get($this->request->data['author']);
            $entity->author      = $this->request->data['author'];
            //$entity->released_in = $this->Books->get($this->request->data['released_in']);
            $entity->released_in = $this->request->data['released_in'];
            
            
            //$this->Books->patchEntity($entity, $this->request->data);
            $this->Books->save($entity);           
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