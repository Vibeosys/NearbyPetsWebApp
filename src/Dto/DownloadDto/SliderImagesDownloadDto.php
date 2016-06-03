<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;

/**
 * Description of SliderImagesDownloadDto
 *
 * @author niteen
 */
class SliderImagesDownloadDto {

    public $url;
    
    public function __construct($url = null) {
        $this->url = $url;
    }
}
