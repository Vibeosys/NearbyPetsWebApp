<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of PostedAdImagesController
 *
 * @author niteen
 */
class PostedAdImagesController extends Apicontroller{
    
    public function getTableObj() {
        return new Table\PostedAdImagesTable();
    }
    public function saveAdImages($images) {
        $result = $this->getTableObj()->insert($images);
        return $result;
    }
    
    public function getAdImages($adId) {
        $result = $this->getTableObj()->getAdImages($adId);
        return $result;
    }
}
