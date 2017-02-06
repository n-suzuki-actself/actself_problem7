<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;

class UsersTable extends Table{
    
    public function getList(){
        $conn = ConnectionManager::get('default');
	$stmt = $conn->query('SELECT * FROM users ORDER BY id DESC;');
	$rows = $stmt->fetchAll('assoc');
	
	return $rows;
       
    }
    
    public function addRecord($mail_address , $password , $name){    
        
        $params = array($mail_address , $password , $name);    
        $conn   = ConnectionManager::get('default');       
        $conn->execute('INSERT INTO users SET mail_address = ? , password = ? , name = ?' , $params);
        // 今登録したレコードを取得する    
        $rows = $this->getRecord($mail_address , "mail_address"); 
        // @updateRecordにハッシュ化を依頼
        $id = $rows['id'];
        $this->updateRecord($id , $mail_address , $password , $name);
        
    } 
           
    public function updateRecord($id , $mail_address , $password , $name){
        
        $conn = ConnectionManager::get('default');
        //登録日時を取得
        $rows = $this->getRecord($id , "id");
        $salt = $rows['created'];
        //パスワードに登録日時連結、ハッシュ化
        $password_with_salt = sha1($password . $salt);
        
        $params = array($mail_address , $password_with_salt , $name , $id);
        //ハッシュ化したパスワードを更新       
        $conn->execute('UPDATE users SET mail_address = ? , password = ? , name = ?  WHERE id = ?' , $params);
               
    } 
    
    public function delRecord($id){  
        
        $params = array($id);
        $conn   = ConnectionManager::get('default');
        $conn->execute('DELETE FROM users WHERE id = ?' , $params);       
    
    }
    
    public function getRecord($val , $column_name){
        
        $params = array($val);
        $conn = ConnectionManager::get('default');
        $sql = 'SELECT * FROM users WHERE '.$column_name.' = ?';
        $stmt = $conn->execute($sql , $params);
	$rows = $stmt->fetch('assoc');
	
	return $rows;
       
    }
    
    public function initialize(array $config){
        
        $this->addBehavior('Timestamp');
            
    }
    
}
