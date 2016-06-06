<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\Dto\UploadDto;

/**
 * Description of PostedAdImagesTable
 *
 * @author niteen
 */
class PostedAdImagesTable extends Table{
    
    public function connect() {
        return TableRegistry::get('posted_ad_images');
    }
    
    public function insert($images) {
        $result = false;
        $imgObj = $this->connect();
        foreach ($images as $img){
            $entity = $imgObj->newEntity();
            $entity->ImageId = $img->imageId;
            $entity->ImageUrl = $img->imageUrl;
            $entity->AdId  = $img->adId;
            $entity->Active = 1;
            $result = $imgObj->save($entity);
        }
        return $result;
    }
    
    public function getAdImages($adId) {
        $adImages = array(); $counter = 0;
        $adImageData = $this->connect()->find('all', ['conditions' => ['AdId' => $adId]]);
        foreach ($adImageData as $adImageRecord){
            $adImages[$counter++] = $adImageRecord -> ImageUrl;            
        }
        return $adImages;
    }
}
