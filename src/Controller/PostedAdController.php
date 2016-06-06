<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Model\Table;
use App\Dto;

/**
 * Description of PostedAdController
 *
 * @author niteen
 */
class PostedAdController extends Apicontroller {

    public function getTableObj() {
        return new Table\PostedAdTable();
    }

    public function changeAdStatus($request) {
        $statusController = new StatusController();
        $status = $statusController->getAdStatus($this->postedAdStatus[$request->status]);
        $result = $this->getTableObj()->updateSatus($request->adId, $status);
        if ($result) {
            return $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(4, null));
        }
        return $this->prepareResponse(Dto\ErrorDto::prepareError(106));
    }

    public function searchAdsForLocation($postedAdLocationRequest) {
        $result = $this->getTableObj()->searchPostedAdsForLocation($postedAdLocationRequest);
        return $result;
    }

}
