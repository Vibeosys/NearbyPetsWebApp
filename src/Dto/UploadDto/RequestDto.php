<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\UploadDto;
use App\Dto;
/**
 * Description of RequestDto
 *
 * @author niteen
 */
class RequestDto extends Dto\JsonDeserializer{
    public $user;
    public $data;
    
    public function __construct($user = null, $data = null) {
        $this->user = $user;
        $this->data = $data;
    }
}
