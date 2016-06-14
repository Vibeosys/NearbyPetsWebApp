<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\UploadDto;
use App\Dto;
/**
 * Description of UserProfileUpdateUploadDto
 *
 * @author niteen
 */
class UserProfileUpdateUploadDto extends Dto\JsonDeserializer{
    
    public $userId;
    public $fname;
    public $lname;
    public $email;
    public $phone;
    public $pwd;
}
