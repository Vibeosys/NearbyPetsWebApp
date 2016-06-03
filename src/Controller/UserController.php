<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
use App\Dto;

/**
 * Description of UserController
 *
 * @author niteen
 */
class UserController extends ApiController{
    
    public function getTableObj() {
        return new Table\UserTable();
    }
    
    public function test() {
        $this->autoRender = FALSE;
        $data['code'] = 1;
        $data['msg'] = 'Route Access';
        $this->response->body(json_encode($data));
    }
    public function login($credential) {
        $this->autoRender = FALSE;
           $pwd = $this->getTableObj()->getCredential($credential->email);
            if($credential->password == $pwd){
            
                return true;
            }
            return FALSE;
    }
    
    public function register($register) {
        $this->autoRender = FALSE;
        if($this->getTableObj()->is_present($register->email)){
            return $this->passwordRecovery(Dto\ErrorDto::prepareError(102));
        }else{
          
            
        }
    }
    
    public function passwordRecovery() {
        $this->autoRender = FALSE;
        if($this->request->is('post')){
            
            
            
            
            
        }
    }
    
  
}
