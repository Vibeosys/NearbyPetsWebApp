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
        if(empty($result))
        return $this->prepareResponse(Dto\ErrorDto::prepareError(112));
        else
        return $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(12, $result));
    }
    public function getAdCategoryList() {
       $result = $this->getTableObj()->getCategoryAdsList();
       if(empty($result))
       return $this->prepareResponse(Dto\ErrorDto::prepareError(112));
       else
       return $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(12, $result));    
    }
}
