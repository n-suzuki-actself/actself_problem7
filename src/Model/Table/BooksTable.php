<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;

class BooksTable extends Table{
    
    public function getList(){
        $conn = ConnectionManager::get('default');
	$stmt = $conn->query('SELECT * FROM books ORDER BY id DESC;');
	$rows = $stmt->fetchAll('assoc');
	return $rows;
       
    }
    
    public function delRecord($id){        
        $params = array($id);        
        $conn = ConnectionManager::get('default');
        $conn->execute('DELETE FROM books WHERE id = ?' , $params);
    
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
        
    }  
    
    public function initialize(array $config){
        
        $this->addBehavior('Timestamp');
        
    }
    
    public function getRecord($id){
        $conn = ConnectionManager::get('default');
        $sql = 'SELECT * FROM books WHERE id =' . $id;
        $stmt = $conn->query($sql);
	$rows = $stmt->fetch('assoc');	
	return $rows;
       
    }
    
    public function updateAverage($book_id , $average){
        $params = array($average , $book_id);       
        $conn = ConnectionManager::get('default');       
        $conn->execute('UPDATE books SET average_score = ? WHERE id = ?' , $params);
     
    }
    
    public function searchRecords($keyword){
        $keyword = "%" . $keyword . "%";    
        $params = array($keyword);
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT * FROM books WHERE title LIKE ?' , $params);
        $rows = $stmt->fetchAll('assoc');
        return $rows;
        
    }
    
}