<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Model\Table;
use App\Dto;
use App\Dto\UploadDto;
use google\appengine\api\cloud_storage\CloudStorageTools;

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
            return $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(4), null);
        }
        return $this->prepareResponse(Dto\ErrorDto::prepareError(106), null);
    }

    public function searchAdsForLocation($postedAdLocationRequest) {
        $postedAdLocationRequest->sortOption = $this->sortOpetions[$postedAdLocationRequest->sortOption];
        $result = $this->getTableObj()->searchPostedAdsForLocation($postedAdLocationRequest);
        return $result;
    }
    
    public function postAnAd($request) {
        $adId = $this->guidGenerator();
        $result = $this->getTableObj()->insert($adId, $request);
        if($result){
            $imageUrl = $this->uploadImages($request->images, $request->userId);
            $counter = 0;
            $images = array();
            foreach ($imageUrl as $key => $value){
                
                $images[$counter++] =  new UploadDto\ImageUploadDto($this->guidGenerator(), $value, $adId);
            }
            if(isset($images[0])){
                $this->getTableObj()->updateAdImage($adId, $images[0]);
            }
            $postedAdImages = new PostedAdImagesController();
            $postedAdImages->saveAdImages($images);
            return $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(9), null);
        }
        return $this->prepareResponse(Dto\ErrorDto::prepareError(109), null);
    }
    
    public function uploadImages($images,$userId) {
 
        $bucket = 'nearby-ads';//CloudStorageTools::getDefaultGoogleStorageBucketName();
        $root_path = 'gs://' . $bucket . '/' . $userId . '/';
 
        $public_urls = [];
        $counter = 0;
        foreach($images as $img) {
            $ext = $this->getExtension($img->imageFileName);
            $type = 'image/'.$ext;
            $imgData = base64_decode($img->imageData);
            $original = $root_path . $img->imageFileName;
            $options = array('gs' => array('acl' => 'public-read','Content-Type' => $type));
            //,
            $stream = stream_context_create($options); 
            file_put_contents($original, $imgData,0,$stream);
          $public_urls[$counter++] = CloudStorageTools::getPublicUrl($original,FALSE);
        }
        return $public_urls;
    }
    
    public function getAdDetails($adId){
        $result = $this->getTableObj()->getAdDetails($adId);
        if(!is_null($result)){
        $postedAdImagesController = new PostedAdImagesController(); 
        $images = $postedAdImagesController->getAdImages($adId);
        $result->images = $images;
        }
        return $result;
    }
    
    public function getHiddenAds($hidden) {
        $status = HIDE_AD ;// $this->postedAdStatus['hidden'];
        $result = $this->getTableObj()->getHidden($hidden->search, $status);
        if(empty($result)){
            return $this->prepareResponse(Dto\ErrorDto::prepareError(111), null);
        }
        return $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(11), $result);
    }
    
    public function getSavedAd($postedAdLocationRequest) {
        $postedAdLocationRequest->sortOption = $this->sortOpetions[$postedAdLocationRequest->sortOption];
        $result = $this->getTableObj()->saveAdCallProcedureByDefaultPhp($postedAdLocationRequest);
        return $result;
    }
    
    public function getcategoryWiseAd($postedAdLocationRequest) {
        $postedAdLocationRequest->sortOption = $this->sortOpetions[$postedAdLocationRequest->sortOption];
        $result = $this->getTableObj()->CategoryWiseAdCallProcedureByDefaultPhp($postedAdLocationRequest);
        return $result;
    }
    
    public function getUserWisePostedAd($postedAdLocationRequest) {
        $postedAdLocationRequest->sortOption = $this->sortOpetions[$postedAdLocationRequest->sortOption];
        $result = $this->getTableObj()->userWiseAdCallProcedureByDefaultPhp($postedAdLocationRequest);
        return $result;
    }
    
    public function addViewToAd($userId, $adId) {
        return $this->getTableObj()->updateView($userId, $adId);
    }
    
    public function statusChangeRightsCheck($adId, $userId) {
        return $this->getTableObj()->isSameUser($adId, $userId);
    }

}
