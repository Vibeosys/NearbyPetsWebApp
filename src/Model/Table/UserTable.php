<?php
namespace App\Model\Table;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ActivateModel
 *
 * @author niteen
 */


use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\Dto;

class UserTable extends Table{
    
    
    public function connect() {
        return TableRegistry::get('user');
    }

    public function is_present($email = null,$fb_token =null) {
        
        if(is_null($email)){
            $conditions = [
                'FbApiToken' => $fb_token
            ]; 
        }  else {
            $conditions = [
                'UserEmail' => $email
            ];
        }
        try{
         $data = $this->connect()->find()->where($conditions);
            if($data->count()){
                return true;
            }
            return FALSE;
        
        }  catch (Exception $e){
            trigger_error('Database error');
        }
    }
    
    public function getCredential($email) {
        $conditions = ['UserEmail' => $email];
        $data = $this->connect()->find()->where($conditions);
        $result = null;
        foreach ($data as $row){
          $result = $row->Pwd;  
        }
        return $result;
    }
    
    public function insert($userId,$register) {
        $Obj = $this->connect();
        $newEntity = $Obj->newEntity();
        $newEntity->UserId = $userId;
        $newEntity->UserEmail = $register->email;
        $newEntity->Pwd = $register->password;
        $newEntity->FirstName = $register->fname;
        $newEntity->LastName = $register->lname;
        $newEntity->Phone = $register->phone;
        $newEntity->CreatedDate = date(DATE_TIME_FORMAT);
        $newEntity->RoleId = 1;
        $newEntity->Active = 1;
        if($Obj->save($newEntity)){
            return true;
        }
        return FALSE;
    }
    
    
}