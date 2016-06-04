<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\Dto\DownloadDto;
/**
 * Description of AdTypesTable
 *
 * @author niteen
 */
class AdTypesTable extends Table{
    
    public function connect() {
        return TableRegistry::get('ad_types');
    }
    
    public function getAll() {
        $rows = $this->connect()->find();
        if($rows->count()){
            $types = array();
            $counter = 0;
            foreach ($rows as $row){
                $types[$counter++] = new DownloadDto\AdTypeDownloadDto($row->AdTypeId, $row->AdTypeDesc);
            }
            return $types;    
        }
        return null;
    }
}
