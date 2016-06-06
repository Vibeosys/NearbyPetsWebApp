<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;
use App\Dto;
/**
 * Description of ConfigSettingsDownloadDto
 *
 * @author niteen
 */
class ConfigSettingsDownloadDto extends Dto\JsonDeserializer{
   
    public $configKey;
    public $configValue;
    public function __construct($key = null, $value = null) {
        
        $this->configKey = $key;
        $this->configValue = $value;
    }
}
