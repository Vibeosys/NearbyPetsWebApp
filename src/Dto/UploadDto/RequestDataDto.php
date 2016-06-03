<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\UploadDto;
use App\Dto;
/**
 * Description of RequestDataDto
 *
 * @author niteen
 */
class RequestDataDto extends Dto\JsonDeserializer{
    
    public $operation;
    public $operationData;
    
    public function __construct($operation = null, $operationData = null) {
        $this->operation = $operation;
        $this->operationData = $operationData;
    }
}
