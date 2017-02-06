<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;

class ReviewsController extends AppController{

    public $name = 'Reviews';
    public $autoRender = false;

    /**
     * 口コミ一覧画面
     */
    
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
    
    public function review($id){
        $books = TableRegistry::get('Books');
        // 口コミ一覧に書籍のタイトルを表示したい
        $rows = $books->getRecord($id);
        $title = $rows['title'];
        $data =[
            'id' => $id,
            'title' => $title            
                
        ];
           
        $this->set('data' , $data);
        $this->Render('/Reviews/review');
        // 口コミ一覧を表示する
        $reviews = TableRegistry::get('Reviews');
        $list = $reviews->getList($id);
        $this->set('list' , $list);
        $this->Render('/Reviews/review');          
            
    }
    
    public function deletereview($id , $book_id){  
        // Tableクラスを呼び出して、削除処理
        $reviews = TableRegistry::get('Reviews');
        $reviews->delRecord($id);                
        // その後、review()へリダイレクト
        $this->redirect(['action' => 'review', $book_id]);
                    
    }
    
    public function addreview($id){
        //GETか？
        if($this->request->is('get')){               
            // GETである
            // 新規登録画面を表示
            $books = TableRegistry::get('Books');
            // 口コミ登録する書籍のタイトルを表示したい
            $rows = $books->getRecord($id);
            $title = $rows['title'];
            $data =[
                'id' => $id,
                'title' => $title                           
            ];
            
            $this->set('data' , $data);
            $this->Render('/Reviews/add_review');
                
        }
        else{
            // GET以外である
            // Tableクラスを呼び出して、登録処理
            $reviews = TableRegistry::get('Reviews');
            
            $header     = $this->request->data('header');
            $nickname   = $this->request->data('nickname');
            $body       = $this->request->data('body');
            $star_count = $this->request->data('star_count');
            $book_id    = $this->request->data('book_id');
            
            $reviews->addRecord($header , $nickname , $body , $star_count , $book_id);
            // その後、review()へリダイレクト  
            return $this->redirect(['action' => 'review', $book_id]);
        }
             
    }
    
    public function updatereview($id){
        // GETか？
        if($this->request->is('get')){               
            // GETである
            // 更新画面を表示
            $books = TableRegistry::get('Books');
            // 口コミ更新する書籍のタイトルを表示したい
            $rows = $books->getRecord($id);
            $title = $rows['title'];
            $data =[
                'id' => $id,
                'title' => $title            
                
            ];               
            $this->set('data' , $data);
            $this->Render('/Reviews/update_review');
                
        }
        else{
            // GET以外である
            // Tableクラスを呼び出して、登録処理
            $reviews = TableRegistry::get('Reviews');
            
            $id         = $this->request->data('id');
            $header     = $this->request->data('header');
            $nickname   = $this->request->data('nickname');
            $body       = $this->request->data('body');
            $star_count = $this->request->data('star_count');
            $book_id    = $this->request->data('book_id');
            
            $reviews->updateRecord($id , $header , $nickname , $body , $star_count , $book_id);
                // その後、review()へリダイレクト
            return $this->redirect(['action' => 'review', $book_id]);
            
        }
             
    }
        


}
