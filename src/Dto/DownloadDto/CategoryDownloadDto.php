<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;

/**
 * Description of CategoryDownloadDto
 *
 * @author niteen
 */
class CategoryDownloadDto {
    
    public $categoryId;
    public $categoryTitle;
    
    public function __construct($categoryId = null, $categoryTitle = null) {
        $this->categoryId = $categoryId;
        $this->categoryTitle = $categoryTitle;
    }
}
