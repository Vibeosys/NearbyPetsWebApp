<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\Dto;
use App\Dto\DownloadDto;

/**
 * Description of StatusTable
 *
 * @author niteen
 */
class StatusTable extends Table{
    
    public function connect() {
        return TableRegistry::get('status');
    }
    
    public function getStatus($desc) {
        $conditions = ['StatusDesc' => $desc];
        $rows = $this->connect()->find()->where($conditions);
        if($rows->count()){
            foreach ($rows as $row){
                return $row->StatusId;
            }
        }
        return 0;
    }
}
