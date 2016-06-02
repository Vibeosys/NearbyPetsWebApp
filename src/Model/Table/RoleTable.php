<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
//use App\Dto;
/**
 * Description of RoleTable
 *
 * @author niteen
 */
class RoleTable extends Table{
    
    public function connct() {
        return TableRegistry::get('role');
    }
    
    public function fetchRoll() {
       
        $counter  = 0;
        $rows = $this->connct()->find();
        if($rows->count()){
            foreach ($rows as $row){
                $response[$counter++] = $row;//[$counter++] = new \RoleDownloadDto($row->RoleId, $row->Role);
            }
            return $response;
        }
        return null;
    }
}
