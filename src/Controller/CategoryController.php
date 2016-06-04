<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of CategoryController
 *
 * @author niteen
 */
class CategoryController extends Apicontroller{
    
    public function getTableObj() {
        return new Table\CategoryTable();
    }
    public function getCategory() {
        $result = $this->getTableObj()->getAll();
        return $this->prepareResponse($result);
    }
}
