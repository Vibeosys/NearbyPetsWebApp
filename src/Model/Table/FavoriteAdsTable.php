<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

/**
 * Description of FavoriteAdsTable
 *
 * @author anand
 */
class FavoriteAdsTable extends Table {

    //put your code here
    public function connect() {
        return TableRegistry::get('favorite_ads');
    }

    public function saveAnAd($favouriteAdRequest) {
        $favouriteAdEntity = $this->newEntity();
        $favouriteAdEntity->AdId = $favouriteAdRequest->adId;
        $favouriteAdEntity->UserId = $favouriteAdRequest->userId;
        $favouriteAdEntity->CreatedDate = date(DATE_TIME_FORMAT);
        $favouriteAdEntity->Active = 1;
        $result = $this->connect()->save($favouriteAdEntity);
        if ($result)
            return true;
        else
            return false;
    }

}
