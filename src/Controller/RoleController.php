<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Controller;
use App\Model\Table;
/**
 * Description of RoleController
 *
 * @author niteen
 */
class RoleController extends AppController{
    
    
    public function getRole() {
          $this->autoRender = FALSE;
        $tableObj = new Table\RoleTable();
        $data = $tableObj->fetchRoll();
        if($data){
             $this->response->body(json_encode($data));
        }else{
             $data['code'] = 404;
             $data['msg'] = 'Role not found';
        }
    }
}
