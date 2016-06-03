<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;

/**
 * Description of ProductDesciptionDownloadDto
 *
 * @author niteen
 */
class ProductDesciptionDownloadDto {
   
    public $pet;
    public $seller;
    public $details;
    public $images;
    public function __construct($pet = null, $seller = null, $details = null, $images = null) {
        
        $this->pet = $pet;
        $this->seller = $seller;
        $this->details= $details;
        $this->images = $images;
    }
}
