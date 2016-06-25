<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;

/**
 * Description of ProductListIosDto
 *
 * @author niteen
 */
class ProductListIosDto extends ProductListDownloadDto{
    
    public $productDesc;
    
    public function __construct($name = null, $description = null, $price = null, 
            $distance = null, $image = null, $adid = null, $date = null) {
        $this->name = $name;
        $this->productDesc = $description;
        $this->price = $price;
        $this->distance = $distance; 
        $this->image = $image;
        $this->adid = $adid;
        $this->postedDate = $date;
    }
}
