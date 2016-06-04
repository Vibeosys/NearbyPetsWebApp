<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;

/**
 * Description of AdTypeDownloadDto
 *
 * @author niteen
 */
class AdTypeDownloadDto {
    
    public $typeId;
    public $typeTitle;
    
    public function __construct($categoryId = null, $categoryTitle = null) {
        $this->typeId = $categoryId;
        $this->typeTitle = $categoryTitle;
    }
}
