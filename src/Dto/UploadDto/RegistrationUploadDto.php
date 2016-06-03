<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\UploadDto;
use App\Dto;
/**
 * Description of RegistrationUploadDto
 *
 * @author niteen
 */
class RegistrationUploadDto  extends Dto\JsonDeserializer{
    
    public $fname;
    public $lname;
    public $phone;
    public $email;
    public $password;
    
    public function __construct($fname = null, $lname = null, $email = null,$password = null, $phone = null) {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->password = $password;
        $this->email = $email;
        $this->phone = $phone;
    }
}
