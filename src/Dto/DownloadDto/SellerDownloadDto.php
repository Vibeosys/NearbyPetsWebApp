<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;

/**
 * Description of SellerDownloadDto
 *
 * @author niteen
 */
class SellerDownloadDto {
    
    public $name;
    public $phone;
    public $email;
    
    public function __construct($name = null, $phone = null, $email = null) {
        
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }
}
