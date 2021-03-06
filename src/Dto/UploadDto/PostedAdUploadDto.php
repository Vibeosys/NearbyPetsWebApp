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
    public $descriptionIos;
    public $address;
    public $displayAddress;
    public $latitude;
    public $longitude;
    public $price;
    public $typeId;
    public $userId;
    public $images;
    public $isAddress;


    public function __construct($categoryId = null, $title = null, $description = null,$descriptionIos = null, 
            $address = null, $displayAddress = null, $lat = null, $long = null,
            $price = null, $typeId = null, $userId = null, $images = null, $isAddress = 1) {
        $this->categoryId = $categoryId;
        $this->title = $title;
        $this->description = $description;
        $this->descriptionIos = $descriptionIos;
        $this->address = $address;
        $this->displayAddress = $displayAddress;
        $this->latitude = $lat;
        $this->longitude = $long;
        $this->price = $price;
        $this->typeId = $typeId;
        $this->userId = $userId;
        $this->images = $images;
        $this->isAddress = $isAddress;
    }
    
}
