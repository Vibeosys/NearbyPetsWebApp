<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\UploadDto;

/**
 * Description of UserPosedAdDto
 *
 * @author niteen
 */
class UserPosedAdDto extends SavedAdLocationRequest{
    
    public $userId;
    
    public function __construct($latitude = NULL, $longitude = NULL, $sortOption = 0,
             $sortChoice = 'DESC', $pageNumber = 1,$userId = null) {
        $this->userId = $userId;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->sortChoice = $sortChoice;
        $this->sortOption = $sortOption;
        $this->pageNumber = $pageNumber;
    }
}
