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
                $postedAdLocationRequest->longitude ."','" . $postedAdLocationRequest->sortChoice."','" .
                $postedAdLocationRequest->sortOption."'," . $postedAdLocationRequest->pageNumber . "";
        $datasource = ConnectionManager::config('default');
        $connection = mysql_connect($datasource['host'], $datasource['username'], $datasource['password']);
        mysql_select_db($datasource['database'], $connection);
        $query = "call " . $name . "(" . $parameters . ");";
        $result = mysql_query($query);
         $adList = array();
         $counter = 0;
        while($procRecord = mysql_fetch_assoc($result)){
            $newAd = new DownloadDto\ProductListDownloadDto();
                $newAd->adid = $procRecord['AdId'];
                $newAd->date = $procRecord['PostedDate'];
                $newAd->description = $procRecord['Description'];
                $newAd->name = $procRecord['AdTitle'];
                $newAd->price = $procRecord['Price'];
                $newAd->image = $procRecord['DisplayImgUrl'];
                $newAd->distance = $procRecord['Distance'];
            $adList[$counter++] = $newAd;
        }
        
        mysql_close($connection);
        return $adList;
    }

}
