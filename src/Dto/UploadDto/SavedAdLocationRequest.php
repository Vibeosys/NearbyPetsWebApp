<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\UploadDto;
use App\Dto;
/**
 * Description of SavedAdLocationRequest
 *
 * @author niteen
 */
class SavedAdLocationRequest extends Dto\JsonDeserializer{
    
    public $latitude;
    public $longitude;
    public $sortOption;  // Sort option is Date 0, Distance 1, Price 2
    public $sortChoice;  // Sort choise is ASC or DESC
    public $pageNumber;
    public $userId;
    public $search;


    public function __construct($latitude = NULL, $longitude = NULL, $sortOption = 0,
             $sortChoice = 'DESC', $pageNumber = 1,$userId = null, $search = "") {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->sortChoice = $sortChoice;
        $this->sortOption = $sortOption;
        $this->pageNumber = $pageNumber;
        $this->userId = $userId;
        $this->search = $search;
    }
}
