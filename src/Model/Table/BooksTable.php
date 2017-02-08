<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;

class BooksTable extends Table{
    
    public function getList(){
        $conn = ConnectionManager::get('default');
	$stmt = $conn->query('SELECT * FROM books ORDER BY id DESC;');
	$rows = $stmt->fetchAll('assoc');
	//var_dump($rows);exit;
	return $rows;
       
    }
    
    public function delRecord($id){
        
        $params = array($id);
        
        $conn = ConnectionManager::get('default');
        $conn->execute(
            'DELETE FROM books WHERE id = ?',
            $params
        );
        
        //$sql = 'DELETE FROM books WHERE id = ' . $id;
        //$conn->query($sql);
    
    }

    public function addRecord($title , $author , $released_in){
        
        $params = array($title , $author , $released_in);
        
        $conn = ConnectionManager::get('default');
       
        $conn->execute('INSERT INTO books SET title = ? , author = ? , released_in = ?', $params);
            
    } 
            
    public function updateRecord($id , $title , $author , $released_in){
        $params = array($title , $author , $released_in , $id);
        $conn = ConnectionManager::get('default');
        $conn->execute('UPDATE books SET title = ? , author = ? , released_in = ?  WHERE id = ?' , $params);
        var_dump($id);
        
    }  
    
    public function initialize(array $config){
        
        $this->addBehavior('Timestamp');
        
    }
    
    public function getRecord($id){
        $conn = ConnectionManager::get('default');
	//$stmt = $conn->query('SELECT * FROM books WHERE id =' . $id);
        $sql = 'SELECT * FROM books WHERE id =' . $id;
        $stmt = $conn->query($sql);
	$rows = $stmt->fetch('assoc');
	
	return $rows;
       
    }
    
    public function averageScore($book_id){
        $conn = ConnectionManager::get('default');
        $sql = 'SELECT * FROM reviews WHERE book_id =' . $book_id;
        $stmt = $conn->query($sql);
	$rows = $stmt->fetchAll('assoc');
        echo $book_id;
        
        $star_count = $rows['star_count'];
        
        //$data = $rows['star_count'];
        foreach($star_count as $star_count):
            
        echo $star_count['star_count'];
        endforeach;
        
        
        
        $age = array(40, 39, 35, 33, 32, 31); // 年齢を代入し、配列を初期化。（代入の順番は入れ替えてもOK。）

	$total = array_sum($star_count); // 配列$ageの合計値を求めて、変数$totalに代入。

	$head_count = count($star_count); // 要素数を数えて、変数$head_countに代入。

	$average = round($total / $head_count); // 平均値を求めて、四捨五入する。

	//$top = max($age); // いちばん大きな数を代入。
        echo $average;
	//print "<p>"."平均年齢は".$average."歳です。"."</p>\n";

	//print "<p>"."一番上は".$top."歳です。"."</p>";
        
    }
    
}