<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Dto\UploadDto;
use App\Dto\DownloadDto;
use App\Dto;

/**
 * Description of UploadController
 *
 * @author niteen
 */
class UploadController extends Apicontroller {

    public function divideWork() {
        $this->autoRender = FALSE;
        if ($this->request->is('post')) {
            $request = $this->request->input();
            $requestEncode = UploadDto\RequestDto::Deserialize($request);
            if(isset($requestEncode->user->email)){
            $isUser = $this->isUser($requestEncode->user,APP_CUSTOM_USER);
            $isAdmin = $this->isUser($requestEncode->user,APP_ADMIN_USER);
            if (!$isUser and !$isAdmin) {
                $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(108)));
                return;
            }
            }

            //$requestData = UploadDto\RequestDataDto::Deserialize($requestEncode->data);
            foreach ($requestEncode->data as $row) {
                switch ($row->operation) {

                    case $this->apiOperation['PL']:
                        $postedAdLocationRequest = UploadDto\PostedAdLocationRequest::Deserialize($row->operationData);
                        $data = $this->searchPostedAdListForLocation($postedAdLocationRequest, $requestEncode->user);
                        if(empty($data)){
                            $response = $this->prepareResponse(Dto\ErrorDto::prepareError(111), null);
                        }else{
                            $response = $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(11), $data);
                        }
                        $this->response->body($response);
                        break;
                    
                    case $this->apiOperation['GSA']:
                        $postedAdLocationRequest = UploadDto\SavedAdLocationRequest::Deserialize($row->operationData);
                        $data = $this->getUserSavedAd($postedAdLocationRequest);
                        if(empty($data)){
                            $response = $this->prepareResponse(Dto\ErrorDto::prepareError(111), null);
                        }else{
                             $response = $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(11), $data);
                        }
                        $this->response->body($response);
                        break;
                    
                    case $this->apiOperation['CPA']:
                        $postedAdLocationRequest = UploadDto\CategoryWisePostedAdsdto::Deserialize($row->operationData);
                        $data = $this->categoryWisePostedAds($postedAdLocationRequest, $requestEncode->user);
                       if(empty($data)){
                            $response = $this->prepareResponse(Dto\ErrorDto::prepareError(111), null);
                        }else{
                             $response = $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(11), $data);
                        }
                        $this->response->body($response);
                        break;
                    
                    case $this->apiOperation['MPA']:
                        $postedAdLocationRequest = UploadDto\UserPosedAdDto::Deserialize($row->operationData);
                        $data = $this->myUserPostedAds($postedAdLocationRequest);
                        if(empty($data)){
                            $response = $this->prepareResponse(Dto\ErrorDto::prepareError(111), null);
                        }else{
                             $response = $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(11), $data);
                        }
                        $this->response->body($response);
                        break;
                    
                    case $this->apiOperation['PD']:
                        $request = UploadDto\ChangeStatusUploadDto::Deserialize($row->operationData);
                        $data = $this->productDescription($request->adId);
                        if(is_null($data)){
                            $response = $this->prepareResponse(Dto\ErrorDto::prepareError(111), null);
                        }else{
                             $response = $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(11), $data);
                              $this->adViews($requestEncode->user,$request->adId);
                        }
                        $this->response->body($response);
                       
                        break;
                    case $this->apiOperation['UL']:
                        $credential = UploadDto\LoginUploadDto::Deserialize($row->operationData);
                        $result = $this->userLogin($credential);
                        if ($result) {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(1), $result));
                        } else {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(101), null));
                        }
                        break;
                    case $this->apiOperation['CL']:
                        $response = $this->categoryList();
                        $this->response->body($response);
                        break;
                    case $this->apiOperation['UR']:
                        $register = UploadDto\RegistrationUploadDto::Deserialize($row->operationData);
                        $this->response->body($this->userRegister($register));
                        break;
                    case $this->apiOperation['FP']:
                        $credential = UploadDto\LoginUploadDto::Deserialize($row->operationData);
                        $this->response->body($this->forgotPassword($credential));
                        break;
                    case $this->apiOperation['GC']:
                        $this->response->body($this->getCategory());
                        break;
                    case $this->apiOperation['GT']:
                        $this->response->body($this->getAdType());
                        break;
                    case $this->apiOperation['SAA']:
                        $isUser = $this->isUser($requestEncode->user,APP_ADMIN_USER);
                        if ($isUser) {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(108)));
                            return;
                        }
                        $saveAnRequest = UploadDto\SaveAnAdDto::Deserialize($row->operationData);
                        $this->response->body($this->saveAnAd($saveAnRequest));
                        break;
                    case $this->apiOperation['GP']:
                        $credential = UploadDto\LoginUploadDto::Deserialize($row->operationData);
                        $this->response->body($this->getProfile($credential));
                        break;
                    case $this->apiOperation['HP']:
                        $isUser = $this->isUser($requestEncode->user,APP_ADMIN_USER);
                        if (!$isUser) {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(108)));
                            return;
                        }
                        $changeStatus = UploadDto\ChangeStatusUploadDto::Deserialize($row->operationData);
                        $changeStatus->status = HIDE_AD;
                        $this->response->body($this->changeHideStatus($changeStatus));
                        break;
                    
                    case $this->apiOperation['DP']:
                        $isUser = $this->isUser($requestEncode->user,APP_CUSTOM_USER);
                        if (!$isUser) {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(108), null));
                            return;
                        }
                        $changeStatus = UploadDto\ChangeStatusUploadDto::Deserialize($row->operationData);
                         $changeStatus->status = DISABLE_AD;
                        $this->response->body($this->changeStatus($changeStatus, $requestEncode->user));
                        break;
                    
                    case $this->apiOperation['SOP']:
                        $isUser = $this->isUser($requestEncode->user,APP_CUSTOM_USER);
                        if (!$isUser) {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(108), null));
                            return;
                        }
                        $changeStatus = UploadDto\ChangeStatusUploadDto::Deserialize($row->operationData);
                         $changeStatus->status = SOLD_OUT_AD;
                        $this->response->body($this->changeStatus($changeStatus, $requestEncode->user));
                        break;
                    case $this->apiOperation['SS']:
                        $isAdminUser = $this->isAdminUser($requestEncode->user);
                        if (!$isAdminUser) {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(108), null));
                            return;
                        }
                        $saveSettingsArray = DownloadDto\ConfigSettingsDownloadDto::DeserializeArray($row->operationData);
                        $saveResult = $this->saveConfigSettins($saveSettingsArray);
                        if ($saveResult) {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(8), null));
                        } else {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(107), null));
                        }
                        //$this->response->body($response);
                        break;
                    case $this->apiOperation['PA']:
                        $adDetails = UploadDto\PostedAdUploadDto::Deserialize($row->operationData);
                        $this->response->body($this->postAd($adDetails));
                        break;
                    case $this->apiOperation['GHA']:
                        $isAdminUser = $this->isAdminUser($requestEncode->user);
                        if (!$isAdminUser) {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(108), null));
                            return;
                        }
                        $hidden = UploadDto\HiddenAdUploadDto::Deserialize($row->operationData);
                        $result = $this->getHiddenAds($hidden);
                        $this->response->body($result);
                        break;
                    case $this->apiOperation['UUR']:
                        $userUpdate = UploadDto\UserUpdateUploadDto::Deserialize($row->operationData);
                        $result = $this->updateUserRadius($userUpdate);
                         $this->response->body($result);
                        break;
                    default :
                        $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(404), null));
                        return;
                        break;
                }
            }
        }
    }
    
    private function updateUserRadius($userUpdate) {
        $userController = new UserController();
        return $userController->updateUser($userUpdate);
    }
    private function isAdminUser($credential) {
        $userController = new UserController();
        $isAdminUser = $userController->isAdmin($credential);
        return $isAdminUser;
    }
    private function isUser($credential,$roll) {
        $userController = new UserController();
        $isAdminUser = $userController->isUser($credential,$roll);
        return $isAdminUser;
    }
    

    private function saveConfigSettins($saveSettingsArray) {
        $configSettingController = new ConfigSettingsController();
        $saveResult = $configSettingController->saveConfigSettings($saveSettingsArray);
        return $saveResult;
    }

    private function register($register) {
        $userController = new UserController();
        return $userController->register($register);
    }

    public function userLogin($data) {
        $userController = new UserController();
        return $userController->login($data);
    }

    private function userRegister($register) {
        $userController = new UserController();
        return $userController->register($register);
    }

    private function forgotPassword($credential) {
        $userController = new UserController();
        return $userController->passwordRecovery($credential->email);
    }

    private function getCategory() {
        $categoryController = new CategoryController();
        return $categoryController->getCategory();
    }

    private function getAdType() {
        $typesController = new AdTypesController();
        return $typesController->getAdTypes();
    }

    private function getProfile($credential) {
        $userController = new UserController();
        return $userController->getUserProfile($credential->email);
    }

    private function changeStatus($changeStatus, $user) {
        
        $postedAdController = new PostedAdController();
        $isSame = $postedAdController->statusChangeRightsCheck($changeStatus->adId, $user->userId);
        if (!$isSame) {
          return  $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(108), null));
        }
        return $postedAdController->changeAdStatus($changeStatus);
    }
    private function changeHideStatus($changeStatus) {
        $postedAdController = new PostedAdController();
        return $postedAdController->changeAdStatus($changeStatus);
    }

    private function searchPostedAdListForLocation($postedAdLocationRequest, $user) {
        $postedAdController = new PostedAdController();
        $postedAdLocationRequest->userId = $user->userId;
        return $postedAdController->searchAdsForLocation($postedAdLocationRequest);
    }
    
    private function postAd($adDetails) {
        $postedAdController = new PostedAdController();
        return $postedAdController->postAnAd($adDetails);
    }
    
    private function productDescription($adId) {
        $postAdcontroller = new PostedAdController();
        $result = $postAdcontroller->getAdDetails($adId);
        return $result;
    }
    private function saveAnAd($saveAnAdRequest) {
        $favoriteAdsController = new FavoriteAdsController();
        $result = $favoriteAdsController->saveAnAd($saveAnAdRequest);
        if($result){
            return $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(10), NULL);
        }
        return $this->prepareResponse(Dto\ErrorDto::prepareError(110), NULL);
    }
    
    public function getUserSavedAd($savedAdLocationRequest) {
         $postedAdController = new PostedAdController();
         return $postedAdController->getSavedAd($savedAdLocationRequest);
    }
    
    private function categoryList() {
         $categoryController = new CategoryController();
        return $categoryController->getAdCategoryList();
    }
    
    public function categoryWisePostedAds($savedAdLocationRequest, $user) {
         $postedAdController = new PostedAdController();
         $savedAdLocationRequest->userId = $user->userId;
         return $postedAdController->getcategoryWiseAd($savedAdLocationRequest);
    }
    
    public function myUserPostedAds($savedAdLocationRequest) {
         $postedAdController = new PostedAdController();
         return $postedAdController->getUserWisePostedAd($savedAdLocationRequest);
    }
    
    public function adViews($user, $adId) {
         $postedAdController = new PostedAdController();
         return $postedAdController->addViewToAd($user->userId, $adId);
    }
    
    public function getHiddenAds($hidden) {
       $postedAdController = new PostedAdController();
       return $postedAdController->getHiddenAds($hidden);
    }

}
