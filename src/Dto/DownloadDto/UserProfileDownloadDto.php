<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\DownloadDto;

/**
 * Description of UserProfileDownloadDto
 *
 * @author niteen
 */
class UserProfileDownloadDto {
    
    public $userid;
    public $fname;
    public $lname;
    public $email;
    public $phone;
    public $roleid;
    public $pwd;
    public $token;
    public $radiusInKm;


    public function __construct($fname= null, $lname = null ,$email = null, 
            $phone = null,$userid =null, $roleid = null, $pwd = null, $token = null, $radius = '10000') {
        
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->phone = $phone;
        $this->userid = $userid;
        $this->roleid = $roleid;
        $this->token = $token;
        $this->pwd = $pwd;
        $this->radiusInKm = $radius;
    }
}
