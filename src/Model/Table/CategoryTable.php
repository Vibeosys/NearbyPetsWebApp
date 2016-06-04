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
 * Description of CategoryTable
 *
 * @author niteen
 */
class CategoryTable extends Table{
   
    
    public function connect() {
        return TableRegistry::get('category');
    }
    
    public function getAll() {
        $rows = $this->connect()->find();
        if($rows->count()){
            $category = array();
            $counter = 0;
            foreach ($rows as $row){
                $category[$counter++] = new DownloadDto\CategoryDownloadDto(
                        $row->CategoryId, $row->CategoryDesc);
            }
            return $category;
        }
        return null;
    }
}
