<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\UploadDto;
use App\Dto;
/**
 * Description of PostedAdUploadDto
 *
 * @author niteen
 */
class PostedAdUploadDto extends Dto\JsonDeserializer{
    
    public $categoryId;
    public $title;
    public $description;
    public $address;
    public $displayAddress;
    public $lat;
    public $long;
    public $price;
    public $typeId;
    public $userId;
    public $images;


    public function __construct($categoryId = null, $title = null, $description = null, 
            $address = null, $displayAddress = null, $lat = null, $long = null,
            $price = null, $typeId = null, $userId = null, $images = null) {
        $this->categoryId = $categoryId;
        $this->title = $title;
        $this->description = $description;
        $this->address = $address;
        $this->displayAddress = $displayAddress;
        $this->lat = $lat;
        $this->long = $long;
        $this->price = $price;
        $this->typeId = $typeId;
        $this->userId = $userId;
        $this->images = $images;
        
    }
    
}
