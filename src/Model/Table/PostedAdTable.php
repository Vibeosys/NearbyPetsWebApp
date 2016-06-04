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
 * Description of PostedAdTable
 *
 * @author niteen
 */
class PostedAdTable extends Table{
    
    public function connect() {
        return TableRegistry::get('posted_ad');
    }
    
    public function updateSatus($adId, $status) {
        $key = ['StatusId' => $status];
        $conditions = ['AdId' => $adId];
        $update = $this->connect()->query()->update();
        $update->set($key);
        $update->where($conditions);
        if($update->execute()){
            return TRUE;
        }
        return FALSE;
    }
}
