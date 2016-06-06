<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto\UploadDto;
use App\Dto;

/**
 * Description of SaveAnAdDto
 *
 * @author anand
 */
class SaveAnAdDto extends Dto\JsonDeserializer{
    //put your code here
    public $adId;
    public $userId;
    public $createDate;
    public $active;
}
