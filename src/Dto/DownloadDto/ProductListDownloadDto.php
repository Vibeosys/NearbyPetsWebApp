<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;

/**
 * Description of ProductListDownloadDto
 *
 * @author niteen
 */
class ProductListDownloadDto {
   
    public $adid;
    public $name;
    public $description;
    public $price;
    public $distance;
    public $image;
    public $postedDate;


    public function __construct($name = null, $description = null, $price = null, 
            $distance = null, $image = null, $adid = null, $date = null) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->distance = $distance; 
        $this->image = $image;
        $this->adid = $adid;
        $this->postedDate = $date;
    }
}
