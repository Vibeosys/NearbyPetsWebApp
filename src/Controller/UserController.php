<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;

/**
 * Description of UserController
 *
 * @author niteen
 */
class UserController extends AppController{
    
    public function getTableObj() {
        return new Table\UserTable();
    }
    
    public function test() {
        $this->autoRender = FALSE;
        $data['code'] = 1;
        $data['msg'] = 'Route Access';
        $this->response->body(json_encode($data));
    }
    public function login() {
        $this->autoRender = FALSE;
        if($this->request->is('post')){
            $parameter = $this->request->data;
            $email = $parameter['email'];
            $password = $parameter['password'];
            $pwd = $this->getTableObj()->getCredential($email);
            if($password == $pwd){
                $data['error'] =0;
                $data['login'] = 'success';
            }else{
                 $data['error'] =1;
                $data['login'] = 'fail';
            }
            $this->response->body(json_encode($data));
        }else{
             $data['code'] = 1;
        $data['msg'] = 'invalid request';
        $this->response->body(json_encode($data));
        }
    }
    
    public function register() {
        $this->autoRender = FALSE;
        if($this->request->is('post')){
            $parameter = $this->request->data;
            $this->response->body(json_encode($parameter));
        }else{
             $data['code'] = 1;
        $data['msg'] = 'invalid request';
        $this->response->body(json_encode($data));
        }
    }
    
  
}
