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
        // GETパラメータをキーで取得
        $sort        = $this->request->query('sort');
        $keyword     = $this->request->query('keyword');
        $column_name = $this->request->query('column_name');
        $search_deal = []; //検索条件
        
        if(! $sort){
            //ソート指定無し
            $search_deal['order'] = ['created' => 'DESC'];
            $this->set('key' , 'rating');
        }
        elseif($sort == 'rating'){
            //評価順
            $search_deal['order'] = ['average_score' => 'DESC'];
            $this->set('key' , 'arrival');
        }
        if(isset($keyword)){
            // キーワード検索
            $search_deal['conditions'] = ["{$column_name} like" => "%{$keyword}%"];           
        }
        $data = $this->Books->find('all', $search_deal);       
        $this->set('data' , $data);
        $this->set('keyword' , $keyword);
        $this->Render('/Books/index');
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
        
        $errors = array();
        
        // POSTか？
        if($this->request->is('post')){
            // ユーザーが入力した書籍情報をオブジェクト化、その後エンティティに保存
            $book_data = $this->Books->newEntity($this->request->data);
            // バリデーションOK、書籍一覧へ
            if($this->Books->save($book_data)){   
                // 登録完了メッセージ表示
                $this->Flash->error('登録完了');
                $this->redirect('/Books/index');
                
            } 
            elseif($book_data->errors()){
                
                
                $this->Flash->error('入力が不当です');               
               // var_dump($errors);
               $errors = $book_data->errors();
               //print_r($errors);
               echo json_encode($errors);exit;
                // バリデーションエラーあり、再度登録画面へ
                $this->set('entity' , $book_data);
                $this->set('errors', $errors);
                $this->Render('/Books/add');
                
            }    
        }
        // GET、登録画面へ
        else{
            $this->set('entity' , $this->Books->newEntity());
            $this->set('errors', $errors);
            $this->Render('/Books/add');
        }
            
    }
    
    public function update($id){
        
        //$entity = $this->Books->get($this->request->data['id']);
        
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
            if($this->Books->save($entity)){ 
                
                $this->redirect('/Books/index');
                
            }
            elseif($entity->errors()){
                $this->Flash->error('入力が不当です');
                $this->set('entity' , $book);
                $this->Render('/Books/update');
            }
        }                         
                    
    }     
    
}