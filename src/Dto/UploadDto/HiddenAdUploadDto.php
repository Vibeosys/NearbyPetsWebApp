<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\UploadDto;
use App\Dto;
/**
 * Description of HiddenAdUploadDto
 *
 * @author niteen
 */
class HiddenAdUploadDto extends Dto\JsonDeserializer{
    
    public $search;
    
    public function __construct($search = "") {
        $this->search = $search;
    }
}
