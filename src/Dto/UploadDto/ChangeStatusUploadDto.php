<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\UploadDto;
use App\Dto;
/**
 * Description of ChangeStatusUploadDto
 *
 * @author niteen
 */
class ChangeStatusUploadDto extends Dto\JsonDeserializer{
    
    public $adid;
    public $status;
    
    public function __construct($adid = null, $status = null) {
        $this->adid = $adid;
        $this->status = $status;
    }
}
