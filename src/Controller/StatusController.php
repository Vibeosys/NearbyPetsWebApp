<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of StatusController
 *
 * @author niteen
 */
class StatusController extends Apicontroller{
    
    public function getTableObj() {
        return new Table\StatusTable();
    }
    
    public function getAdStatus($desc) {
        return $this->getTableObj()->getStatus($desc);
    }
}
