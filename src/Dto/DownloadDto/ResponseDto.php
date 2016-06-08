<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;

/**
 * Description of ResponseDto
 *
 * @author niteen
 */
class ResponseDto {
    
    public $error;
    public $settings;
    public $data;
    
    public function __construct($settings = null,$data = null, $error = null) {
        $this->settings = $settings;
        $this->data = $data;
        $this->error = $error;
    }
}
