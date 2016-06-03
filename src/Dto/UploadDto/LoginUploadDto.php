<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\UploadDto;
use App\Dto;
/**
 * Description of LoginUploadDto
 *
 * @author niteen
 */
class LoginUploadDto extends Dto\JsonDeserializer{
    
    public  $email;
    public  $password;
    
    public function __construct($email = null, $password = null) {
        $this->email = $email;
        $this->password = $password;
    }
}
