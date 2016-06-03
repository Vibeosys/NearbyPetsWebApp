<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;

/**
 * Description of AdDetailsDownloadDto
 *
 * @author niteen
 */
class AdDetailsDownloadDto {

    public $date;
    public $views;
    public $distance;
    
    public function __construct($date = null, $views = null, $distance = null) {
        
        $this->date = $date;
        $this->views = $views;
        $this->distance = $distance;
    }
}
