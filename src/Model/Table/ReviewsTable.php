<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;

class ReviewsTable extends Table{
    
    public function getList($id){
        $conn = ConnectionManager::get('default');
	$sql = 'SELECT * FROM reviews WHERE book_id =' . $id;
        $stmt = $conn->query($sql);
	$rows = $stmt->fetchAll('assoc');
	
	return $rows;
       
    }
    
    public function delRecord($id){
        
        $params = array($id);
        
        $conn = ConnectionManager::get('default');
        $conn->execute('DELETE FROM reviews WHERE id = ?' , $params);       
        //$sql = 'DELETE FROM books WHERE id = ' . $id;
        //$conn->query($sql);
    
    }

    public function addRecord($header , $nickname , $body , $star_count , $book_id){
        
        $params = array($header , $nickname , $body , $star_count , $book_id);
        
        $conn = ConnectionManager::get('default');
       
        $conn->execute('INSERT INTO reviews SET header = ? , nickname = ? , body = ? , star_count = ? , book_id = ?', $params);
            
    } 
           
    public function updateRecord($id , $header , $nickname , $body , $star_count , $book_id){
        $params = array($header , $nickname , $body , $star_count , $book_id , $id);
        $conn = ConnectionManager::get('default');
        $conn->execute('UPDATE reviews SET header = ? , nickname = ? , body = ? , star_count = ? , book_id = ?  WHERE id = ?' , $params);
        //var_dump($id);
        
    }  
    
    public function initialize(array $config){
        
        $this->addBehavior('Timestamp');
    }
    
    public function getRecord($id){
        $conn = ConnectionManager::get('default');
	//$stmt = $conn->query('SELECT * FROM books WHERE id =' . $id);
        $sql = 'SELECT * FROM reviews WHERE id =' . $id;
        var_dump($sql);
        $stmt = $conn->query($sql);
	$rows = $stmt->fetch('assoc');
	
	return $rows;
       
    }
    
}