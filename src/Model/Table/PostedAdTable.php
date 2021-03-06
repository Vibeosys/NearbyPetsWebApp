<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\Dto;
use App\Dto\DownloadDto;
use Cake\Database\Type\DateTimeType;

/**
 * Description of PostedAdTable
 *
 * @author niteen
 */
class PostedAdTable extends Table {

    public $connection;

    public function connect() {
        return TableRegistry::get('posted_ad');
    }

    public function updateSatus($adId, $status) {
        $key = ['StatusId' => $status];
        $conditions = ['AdId' => $adId];
        $update = $this->connect()->query()->update();
        $update->set($key);
        $update->where($conditions);
        if ($update->execute()) {
            return TRUE;
        }
        return FALSE;
    }
    
    public function isSameUser($adId, $userId) {
        $conditions = [
            'Adid =' => $adId,
            'UserId =' => $userId
        ];
        
        $rows = $this->connect()->find()->where($conditions);
        if($rows->count()){
            return true;
        }
        return FALSE;
    }

    public function searchPostedAdsForLocation($postedAdLocationRequest) {
        /* $this->connection = ConnectionManager::get('default');
          //$this->connection->logQueries(true);

          $name = "getPostedAdList";
          $parameters = "'".$postedAdLocationRequest->latitude . "','" . $postedAdLocationRequest->longitude."'";
          $proc_result = $this->connect()->query("CALL `$name`($parameters);");
          //print_r($proc_result);

          $proc_data = array();

          if (false !== $proc_result) {
          while ($proc_row = mysqli_fetch_array($proc_result)) {
          $proc_data[] = $proc_row;
          }
          } */

        /* $counter = 0;
          $adList = array();

          if (!empty($proc_result)) {
          //do whatever with procedure data
          foreach ($proc_result as $procRecord)
          {
          $newAd = new DownloadDto\ProductListDownloadDto();
          $newAd->adid = $procRecord->AdId;
          $newAd->date = $procRecord->PostedDate;
          $newAd->description = $procRecord->Description;
          $newAd->name = $procRecord->AdTitle;
          $newAd->price = $procRecord->Price;
          $newAd->image = $procRecord->DisplayImgUrl;
          $newAd->distance = $procRecord->Distance;
          $adList[$counter++] = $newAd;
          }
          }
          return $adList; */
        return $this->callProcedureByDefaultPhp($postedAdLocationRequest);
    }

    public function callProcedure($name = NULL, $inputParameter = array(), $outputParameter = array()) {
        $this->begin();
        $parameter = "";
        $outputParam = "";
        foreach ($inputParameter as $params) {
            $parameter .= $parameter == "" ? " '$params' " : ", '$params' ";
        }

        if (count($outputParameter) > 0) {
            foreach ($outputParameter as $prm) {
                $outputParam .= $outputParam == "" ? " @$prm " : ", @$prm ";
            }
        }
        $parameter = ($outputParam) ? $parameter . ", " . $outputParam : $parameter;
        $this->query("CALL `$name`($parameter);");
        $result = $this->query("SELECT $outputParam");
        $this->commit();
        return $result;
    }

    public function callProcedureByDefaultPhp($postedAdLocationRequest) {
        $name = "getPostedAdList";
        $parameters = "'" . $postedAdLocationRequest->latitude . "','" . 
                $postedAdLocationRequest->userId . "','" .
                $postedAdLocationRequest->longitude . "','" . $postedAdLocationRequest->sortChoice . "','" .
                $postedAdLocationRequest->sortOption . "'," . $postedAdLocationRequest->pageNumber . ",'" 
                . $postedAdLocationRequest->search . "'";
        $datasource = ConnectionManager::config('default');
        $connection = mysql_connect($datasource['host'], $datasource['username'], $datasource['password']);
        mysql_select_db($datasource['database'], $connection);
        $query = "call " . $name . "(" . $parameters . ");";
        $result = mysql_query($query);
        //echo 'result from stored proce'.$result;
        $count = mysql_num_rows($result);
        $adList = array();
        $counter = 0;
        if (!is_bool($result)) {
            if ($count) {
                while ($procRecord = mysql_fetch_assoc($result)) {
                    $newAd = new DownloadDto\ProductListDownloadDto();
                    $newAd->adid = $procRecord['AdId'];
                    $date = new \Cake\I18n\Date($procRecord['PostedDate']);
                    $newAd->postedDate = $date;
                    $newAd->description = $procRecord['Description'];
                    $newAd->name = $procRecord['AdTitle'];
                    $newAd->price = $procRecord['Price'];
                    $newAd->image = $procRecord['DisplayImgUrl'];
                    $newAd->distance = $procRecord['Distance'];
                    $adList[$counter++] = $newAd;
                }
            }
        }

        mysql_close($connection);
        return $adList;
    }
    
    public function saveAdCallProcedureByDefaultPhp($postedAdLocationRequest) {
        $name = "getSavedAdList";
        $parameters = "'" . $postedAdLocationRequest->latitude . "','" .
                $postedAdLocationRequest->longitude . "','" . $postedAdLocationRequest->sortChoice . "','" .
                $postedAdLocationRequest->sortOption . "'," . $postedAdLocationRequest->pageNumber . ",'" . 
                $postedAdLocationRequest->userId . "','" . $postedAdLocationRequest->search . "'";
        $datasource = ConnectionManager::config('default');
        $connection = mysql_connect($datasource['host'], $datasource['username'], $datasource['password']);
        mysql_select_db($datasource['database'], $connection);
        $query = "call " . $name . "(" . $parameters . ");";
        $result = mysql_query($query);
        //echo 'result from stored proce'.$result;
        
        $adList = array();
        $counter = 0;
        if (!is_bool($result)) {
            $count = mysql_num_rows($result);
            if ($count) {
                while ($procRecord = mysql_fetch_assoc($result)) {
                    $newAd = new DownloadDto\ProductListDownloadDto();
                    $newAd->adid = $procRecord['AdId'];
                    $date = new \Cake\I18n\Date($procRecord['PostedDate']);
                    $newAd->postedDate = $date;
                    $newAd->description = $procRecord['Description'];
                    $newAd->name = $procRecord['AdTitle'];
                    $newAd->price = $procRecord['Price'];
                    $newAd->image = $procRecord['DisplayImgUrl'];
                    $newAd->distance = $procRecord['Distance'];
                    $adList[$counter++] = $newAd;
                }
            }
        }

        mysql_close($connection);
        return $adList;
    }
    
    public function CategoryWiseAdCallProcedureByDefaultPhp($postedAdLocationRequest) {
        $name = "getCategoryWisePostedAdList";
        $parameters = "'" . $postedAdLocationRequest->categoryId . "','" . 
                $postedAdLocationRequest->userId . "','" 
                .$postedAdLocationRequest->search. "','" .$postedAdLocationRequest->latitude . "','" .
                $postedAdLocationRequest->longitude . "','" . $postedAdLocationRequest->sortChoice . "','" .
                $postedAdLocationRequest->sortOption . "'," . $postedAdLocationRequest->pageNumber . "";
        $datasource = ConnectionManager::config('default');
        $connection = mysql_connect($datasource['host'], $datasource['username'], $datasource['password']);
        mysql_select_db($datasource['database'], $connection);
        $query = "call " . $name . "(" . $parameters . ");";
        $result = mysql_query($query);
        //echo 'result from stored proce'.$result;
        
        $adList = array();
        $counter = 0;
        if (!is_bool($result)) {
            $count = mysql_num_rows($result);
            if ($count) {
                while ($procRecord = mysql_fetch_assoc($result)) {
                    $newAd = new DownloadDto\ProductListDownloadDto();
                    $newAd->adid = $procRecord['AdId'];
                     $date = new \Cake\I18n\Date($procRecord['PostedDate']);
                    $newAd->postedDate = $date;
                    $newAd->description = $procRecord['Description'];
                    $newAd->name = $procRecord['AdTitle'];
                    $newAd->price = $procRecord['Price'];
                    $newAd->image = $procRecord['DisplayImgUrl'];
                    $newAd->distance = $procRecord['Distance'];
                    $adList[$counter++] = $newAd;
                }
            }
        }

        mysql_close($connection);
        return $adList;
    }
    
     public function userWiseAdCallProcedureByDefaultPhp($postedAdLocationRequest) {
        $name = "getUserPostedAdList";
        $parameters = "'" . $postedAdLocationRequest->userId . "','" .$postedAdLocationRequest->latitude . "','" .
                $postedAdLocationRequest->longitude . "','" . $postedAdLocationRequest->sortChoice . "','" .
                $postedAdLocationRequest->sortOption . "'," . $postedAdLocationRequest->pageNumber . ",'" .
                $postedAdLocationRequest->search . "'";
        $datasource = ConnectionManager::config('default');
        $connection = mysql_connect($datasource['host'], $datasource['username'], $datasource['password']);
        mysql_select_db($datasource['database'], $connection);
        $query = "call " . $name . "(" . $parameters . ");";
        $result = mysql_query($query);
        //echo 'result from stored proce'.$result;
        
        $adList = array();
        $counter = 0;
        if (!is_bool($result)) {
            $count = mysql_num_rows($result);
            if ($count) {
                while ($procRecord = mysql_fetch_assoc($result)) {
                    $newAd = new DownloadDto\ProductListDownloadDto();
                    $newAd->adid = $procRecord['AdId'];
                     $date = new \Cake\I18n\Date($procRecord['PostedDate']);
                    $newAd->postedDate = $date;
                    $newAd->description = $procRecord['Description'];
                    $newAd->name = $procRecord['AdTitle'];
                    $newAd->price = $procRecord['Price'];
                    $newAd->image = $procRecord['DisplayImgUrl'];
                    $newAd->distance = $procRecord['Distance'];
                    $adList[$counter++] = $newAd;
                }
            }
        }

        mysql_close($connection);
        return $adList;
    }

    public function insert($adId, $postAd) {

        $obj = $this->connect();
        $entity = $obj->newEntity();
        $entity->AdId = $adId;
        $entity->UserId = $postAd->userId;
        $entity->AdTitle = $postAd->title;
        $entity->Description = $postAd->description;
        $entity->Address = $postAd->address;
        $entity->DisplayAddress = $postAd->displayAddress;
        $entity->Latitude = $postAd->latitude;
        $entity->Longitude = $postAd->longitude;
        $entity->Price = $postAd->price;
        $entity->AdTypeId = $postAd->typeId;
        //$entity->StatusId = $postAd->
        $entity->Active = 1;
        $entity->PostedDate = date(DATE_TIME_FORMAT);
        //$entity->DisplayImgUrl = 
        $entity->CategoryId = $postAd->categoryId;
        $entity->AddressType = $postAd->isAddress;

        if ($obj->save($entity)) {
            return TRUE;
        }
        return FALSE;
    }

    public function getAdDetails($adId) {
        $this->connect()->belongsTo('user', [
            'foreignKey' => 'UserId',
            'joinType' => 'INNER',
            'conditions' => ['user.Active' => 1]
        ]);

        $adDetails = $this->connect()->find('all', ['fields' => ['AdId',
                'AdTitle',
                'Description',
                'Price',
                'PostedDate',
                'AdViews',
                'Latitude',
                'Longitude',
                'Address',
                'DisplayAddress',
                'AddressType',
                'user.FirstName',
                'user.LastName',
                'user.Phone',
                'user.UserEmail'],
            'conditions' => ['AdId' => $adId],
            'contain' => ['user']]
        );

        $adResult = null;
        if($adDetails->count()){
        foreach ($adDetails as $adRecord) {
            $adResult = new DownloadDto\ProductDesciptionDownloadDto();
            $adResult->adId = $adRecord->AdId;
            $adResult->adTitle = $adRecord->AdTitle;
            $adResult->description = $adRecord->Description;
            $adResult->price = $adRecord->Price;
            $adResult->postedDate = $adRecord->PostedDate;
            $adResult->adViews = $adRecord->AdViews;
            $adResult->latitude = $adRecord->Latitude;
            $adResult->longitude = $adRecord->Longitude;
            $adResult->adAddress = $adRecord->Address;
            $adResult->displayAddress = $adRecord->DisplayAddress;
            $adResult->name = $adRecord->user->FirstName . " " . $adRecord->user->LastName;
            $adResult->phone = $adRecord->user->Phone;
            $adResult->email = $adRecord->user->UserEmail;
            $adResult->isAddress = $adRecord->AddressType;
        }}
        return $adResult;
        //$this->connect()->get($adId)->;
    }
    
    public function getHidden($search, $status) {
        $conditions = [
            'StatusId  =' => $status,
            'AdTitle LIKE' => '%'.$search.'%',   
            'Description LIKE' => '%'.$search.'%'   
            ];
        $rows = $this->connect()->find()->where($conditions);
        $hiddenAds = array();
        if($rows->count()){
            $counter = 0;
            foreach ($rows as $row){
              $hiddenAds[$counter++] = new DownloadDto\ProductListDownloadDto(
                      $row->AdTitle, 
                      $row->Description, 
                      $row->Price, 
                      $row->Distance, 
                      $row->DisplayImgUrl, 
                      $row->AdId, 
                      $row->PostedDate);  
                
            }
        }
        return $hiddenAds;
        
    }
    
    public function updateAdImage($adId, $img) {
        $conditions = ['AdId =' => $adId ];
        $key = ['DisplayImgUrl' => $img->imageUrl];
        $update = $this->connect()->query()->update();
        $update->set($key);
        $update->where($conditions);
        if($update->execute()){
            return TRUE;
        }
        return FALSE;
    }
    
    public function updateView($userId, $adId) {
        $tObj = $this->connect();
        $condition = ['AdId =' => $adId, 'UserId =' => $userId];
        $rows = $tObj->find()->where($condition);
        if($rows->count()){
            return NULL;
        }
        $updateObj = $tObj->get($adId);
        $updateObj->AdViews = $updateObj->AdViews + 1;
        if($tObj->save($updateObj)){
            return TRUE;
        }
        return FALSE;
    }

}
