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
    
    public $fname;
    public $lname;
    public $email;
    public $phone;
    
    public function __construct($fname= null, $lname = null ,$email = null, 
            $phone = null) {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->phone = $phone;
    }
}
