<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;

/**
 * Description of CategoryListDownloadDto
 *
 * @author niteen
 */
class CategoryListDownloadDto {
    
    public  $title;
    public  $products;
    public $image;
    
    public function __construct($title = null, $products = null, $image = null) {
        $this->title = $title;
        $this->products = $products;
        $this->image = $image;
    }
}
