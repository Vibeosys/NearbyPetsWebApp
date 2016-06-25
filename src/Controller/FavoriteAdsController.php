<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;

/**
 * Description of FavoriteAdsController
 *
 * @author anand
 */
class FavoriteAdsController extends Apicontroller{
    //put your code here
    public function saveAnAd($saveAnAdRequest)
    {
        $tableObj = new Table\FavoriteAdsTable();
        return $tableObj->saveAnAd($saveAnAdRequest);
    }
     
    public function removeAnAd($removeAnAdRequest)
    {
        $tableObj = new Table\FavoriteAdsTable();
        return $tableObj->removeSavedAd($removeAnAdRequest);
    }
    
}
