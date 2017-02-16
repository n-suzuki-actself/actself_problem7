<?php

namespace App\Controller;
//use Cake\ORM\TableRegistry;

class ReviewsController extends AppController{

    public $name = 'Reviews';
    public $autoRender = false;

    /**口コミ助
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
        $rows = $this->Reviews->findByBook_id($id)
                ->order(['created' => 'DESC']);
                //['order' => ['created' =>'DESC']]);
        $this->set('rows' , $rows);
        //$this->set('entity' , $this->Reviews->newEntity());
        $this->Render('/Reviews/review');
    }
    
//    public function review($id){
//        //$books = TableRegistry::get('Books');
//        // 口コミ一覧に書籍のタイトルを表示したい
//        $rows = $books->getRecord($id);
//        $title = $rows['title'];
//        $data =[
//            'id'    => $id,
//            'title' => $title            
//                
//        ];
//           
//        $this->set('data' , $data);
//        $this->Render('/Reviews/review');
//        // 口コミ一覧を表示する
//        $reviews = TableRegistry::get('Reviews');
//        $list = $reviews->getList($id);
//        $this->set('list' , $list);
//        $this->Render('/Reviews/review');          
//            
//    }
    
    public function deletereview($id , $book_id){  
        // Tableクラスを呼び出して、削除処理
        $reviews = TableRegistry::get('Reviews');
        $reviews->delRecord($id);  
        // 口コミの5段階評価の平均点を計算を委託
        $this->_average($book_id);                          
        // その後、review()へリダイレクト
        $this->redirect(['action' => 'review', $book_id]);
                    
    }
    
    public function addreview($id){
        //GETか？
        if($this->request->is('get')){               
            // GETである
            // CSRF対策 ワンタイムトークン発行
            // セッションに記録
            $str = sha1(time());
            $_SESSION['one_time_token'] = $str;
            $this->set('str' , $str);            
            // 新規登録画面を表示
            $books = TableRegistry::get('Books');
            // 口コミ登録する書籍のタイトルを表示したい
            $rows = $books->getRecord($id);
            $title = $rows['title'];
            $data =[
                'id'    => $id,
                'title' => $title                           
            ];
            
            $this->set('data' , $data);
            $this->Render('/Reviews/add_review');
                
        }// ワンタイムトークンが一致するか
        elseif($_SESSION['one_time_token'] != $this->request->data('one_time_token')) {
            
            echo '危険なアクセス'; 
            
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
            // 口コミの5段階評価の平均点を計算を委託
            $this->_average($book_id);          
            // その後、review()へリダイレクト  
            return $this->redirect(['action' => 'review', $book_id]);
            
        }
             
    }
    
    public function updatereview($id){
        // GETか？
        if($this->request->is('get')){               
            // GETである
            // CSRF対策 ワンタイムトークン発行
            // セッションに記録            
            $str = sha1(time());
            $_SESSION['one_time_token'] = $str;
            $this->set('str' , $str);
            // 更新画面を表示
            $books = TableRegistry::get('Books');
            // 口コミ更新する書籍のタイトルを表示したい
            $rows = $books->getRecord($id);
            $title = $rows['title'];
            $data =[
                'id'    => $id,
                'title' => $title            
                
            ];               
            $this->set('data' , $data);
            $this->Render('/Reviews/update_review');
                
        }// ワンタイムトークンが一致するか       
        elseif($_SESSION['one_time_token'] != $this->request->data('one_time_token')) {
            
            echo '危険なアクセス'; 
            
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
            // 口コミの5段階評価の平均点を計算を委託
            $this->_average($book_id);            
            // その後、review()へリダイレクト
            return $this->redirect(['action' => 'review', $book_id]);
            
        }
             
    }
    
    private function _average($book_id){
        $reviews = TableRegistry::get('Reviews');
        // 口コミの5段階評価の平均点を計算する
        $rows = $reviews->getList($book_id);           
        $record_count = 0;
        $total= 0;
        // 書籍に紐づく口コミのレコード合計数と口コミ評価合計数を計算する
        foreach($rows as $data):
                
            $record_count++;
            $total = $total+$data['star_count'];
                
        endforeach;
            
        $average = round($total/$record_count , 2);
        // 平均点をbooksテーブル＠average_scoreカラムに更新する
        $books = TableRegistry::get('Books');
        $books->updateAverage($book_id , $average);
            
    }

}
