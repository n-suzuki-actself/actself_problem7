<?php

namespace App\Controller;

class BooksController extends AppController{

    public $name = 'Books';
    public $autoRender = false;
    
    public function __construct(\Cake\Network\Request $request = null, \Cake\Network\Response $response = null, $name = null, $eventManager = null, $components = null) {
        parent::__construct($request, $response, $name, $eventManager, $components);
        session_start();
        //$this->request->session()->read('login');
        if(! isset($_SESSION['login'])){
            // ログインされてない
            // リダイレクト　ログイン画面へ
            return $this->redirect(['controller' => 'Logins', 'action' => 'login']);
        }// セッションの値もチェック
        elseif($_SESSION['login'] !== true){
            
            return $this->redirect(['controller' => 'Logins', 'action' => 'login']);
            
        }
        
    }
           
    public function index(){
        // GETパラメータをsortキーで取得
        $sort = $this->request->query('sort');
        //値が取れない
        if(! $sort){
            // 書籍の新規順に一覧表示
            $data = $this->Books->find('all', ['order' => ['created' => 'DESC']]);
            $this->set('data' , $data);
            // 書籍の評価順リンクを用意
            $this->set('key' , 'rating');
            $this->Render('/Books/index');
            
        }
        elseif($sort == 'rating'){
            // 書籍の評価順に並び替え
            $data = $this->Books->find('all', ['order' => ['average_score' => 'DESC']]);
            $this->set('data' , $data);
            // 書籍の新規順リンクを用意
            $this->set('key' , 'arrival');
            $this->Render('/Books/index');
        
        }
        // 書籍キーワード検索、keywordキーを取得
        $keyword = $this->request->query('keyword');
        //多分ここでデコードする $keyword = urldecode($keyword);
        if(isset($keyword)){ 
            // ユーザーが入力したキーワードを検索
            $data = $this->Books->find('all' , [
                'conditions'=>[
                    'title like'=>"%{$keyword}%"
                ]
            ]);
            // 検索結果を表示
            $this->set('keyword' , $keyword);
            $this->set('data' , $data);
            $this->Render('/Books/index');
            
        }
   
    }
                       
    public function delete($id){  
        // GETか？
        if($this->request->is('get')){
            // 書籍IDでエンティティを取得、その後エンティティの削除
            $entity = $this->Books->get($id);            
            $this->Books->delete($entity);
            // その後、index()へリダイレクト
            $this->redirect('/Books/index');
            
        }           
    }    
    
    
    public function add(){ 
        // POSTか？
        if($this->request->is('post')){
            // ユーザーが入力した書籍情報をオブジェクト化、その後エンティティに保存
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
        // GETか？
        if($this->request->is('get')){                       
            // 更新画面を表示
            $book = $this->Books->get($id);            
            $this->set('entity' , $book);
            $this->Render('/Books/update');
        }
        else{
            // 更新処理、書籍IDでエンティティ取得
            $entity = $this->Books->get($this->request->data['id']);  
            // フォームから入力情報を取得してエンティティに代入
            $entity->title       = $this->request->data['title'];
            $entity->author      = $this->request->data['author'];
            $entity->released_in = $this->request->data['released_in'];
            // 更新後の情報をエンティティに保存
            $this->Books->save($entity);           
            $this->redirect('/Books/index');
            
        }                         
                    
    }     
    
}