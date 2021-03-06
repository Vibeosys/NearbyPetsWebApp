<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\UploadDto;
use App\Dto;
/**
 * Description of ImageUploadDto
 *
 * @author niteen
 */
class ImageUploadDto extends Dto\JsonDeserializer{
    
    public $imageId;
    public $imageUrl;
    public $adId;
    
    public function __construct($imageId = null, $imageFileName = null,$imagedata = null) {
        $this->imageId =$imageId;
        $this->imageUrl = $imageFileName;
        $this->adId= $imagedata;
    }
}
