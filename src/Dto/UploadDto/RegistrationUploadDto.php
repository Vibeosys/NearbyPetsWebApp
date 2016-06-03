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
    public $token;
    public $source;
    public $url;


    public function __construct($fname = null, $lname = null, $email = null,
            $password = null, $phone = null, $token = null, $source = null, $url = null) {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->password = $password;
        $this->email = $email;
        $this->phone = $phone;
        $this->token = $token;
        $this->source = $source;
        $this->url = $url;
       
    }
}
