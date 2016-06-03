<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;

/**
 * Description of PetDownloadDto
 *
 * @author niteen
 */
class PetDownloadDto {
    
    public  $title;
    public $price;
    public $description;
    
    public function __construct($title = null, $price = null, $description = null) {
        $this->title = $title;
        $this->price = $price;
        $this->description = $description;
    }
}
