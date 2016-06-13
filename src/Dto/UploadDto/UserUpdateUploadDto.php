<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\UploadDto;
use App\Dto;
/**
 * Description of UserUpdateUploadDto
 *
 * @author niteen
 */
class UserUpdateUploadDto extends Dto\JsonDeserializer{
    
    public $userId;
    public $radiusInKm;
}
