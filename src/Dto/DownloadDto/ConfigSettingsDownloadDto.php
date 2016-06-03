<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;

/**
 * Description of ConfigSettingsDownloadDto
 *
 * @author niteen
 */
class ConfigSettingsDownloadDto {
   
    public $key;
    public $value;
    public function __construct($key = null, $value = null) {
        
        $this->key = $key;
        $this->value = $value;
    }
}
