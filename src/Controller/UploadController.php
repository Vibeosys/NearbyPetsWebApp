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

            //$requestData = UploadDto\RequestDataDto::Deserialize($requestEncode->data);
            foreach ($requestEncode->data as $row) {
                switch ($row->operation) {

                    case $this->apiOperation['PL']:
                        $postedAdLocationRequest = UploadDto\PostedAdLocationRequest::Deserialize($row->operationData);
                        $this->searchPostedAdListForLocation($postedAdLocationRequest);
                        $response = $this->prepareResponse($data);
                        $this->response->body($response);
                        break;

                    case $this->apiOperation['PD']:
                        $pet[0] = new DownloadDto\PetDownloadDto("dog", 200, 'black color');
                        $seller[0] = new DownloadDto\SellerDownloadDto("mark", 9922334455, "mark@gmail.com");
                        $details[0] = new DownloadDto\AdDetailsDownloadDto('23/05/2016', 4, 3);
                        $images[0] = new DownloadDto\SliderImagesDownloadDto('http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                        $images[1] = new DownloadDto\SliderImagesDownloadDto('http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                        $images[2] = new DownloadDto\SliderImagesDownloadDto('http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                        foreach ($pet as $key => $value) {
                            $data[$key] = new DownloadDto\ProductDesciptionDownloadDto($value, $seller[$key], $details[$key], $images);
                        }
                        $response = $this->prepareResponse($data);
                        $this->response->body($response);
                        break;
                    case $this->apiOperation['UL']:
                        $credential = UploadDto\LoginUploadDto::Deserialize($row->operationData);
                        $result = $this->userLogin($credential);
                        if ($result) {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(1, $result)));
                        } else {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(101)));
                        }
                        break;
                    case $this->apiOperation['CL']:
                        $category[0] = new DownloadDto\CategoryListDownloadDto("Parret", 20, 'animals.sandiegozoo.org/sites/default/files/styles/square_thumbnail/public/bowerbird_thumb.jpg');
                        $category[1] = new DownloadDto\CategoryListDownloadDto("sparrow", 20, 'animals.sandiegozoo.org/sites/default/files/styles/square_thumbnail/public/bowerbird_thumb.jpg');
                        $category[2] = new DownloadDto\CategoryListDownloadDto("Dog", 20, 'animals.sandiegozoo.org/sites/default/files/styles/square_thumbnail/public/bowerbird_thumb.jpg');
                        $response = $this->prepareResponse($category);
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
                    case $this->apiOperation['GP']:
                        $credential = UploadDto\LoginUploadDto::Deserialize($row->operationData);
                        $this->response->body($this->getProfile($credential));
                        break;
                    case $this->apiOperation['CS']:
                        $changeStatus = UploadDto\ChangeStatusUploadDto::Deserialize($row->operationData);
                        $this->response->body($this->changeStatus($changeStatus));
                        break;
                    case $this->apiOperation['SS']:
                        $isAdminUser = $this->isAdminUser($row->user);
                        if (!$isAdminUser) {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(108)));
                            return;
                        }
                        $saveSettingsArray = Dto\JsonDeserializer::Deserialize($row->operationData);
                        $saveResult = $this->saveConfigSettins($saveSettingsArray);
                        if ($saveResult) {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(8)));
                        } else {
                            $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(107)));
                        }
                        //$this->response->body($response);
                        break;
                }
            }
        }
    }

    private function isAdminUser($credential) {
        $userController = new UserController();
        $isAdminUser = $userController->isAdmin($credential);
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

    private function changeStatus($changeStatus) {
        $postedAdController = new PostedAdController();
        return $postedAdController->changeAdStatus($changeStatus);
    }

    private function searchPostedAdListForLocation($postedAdLocationRequest) {
        $postedAdController = new PostedAdController();
        return $postedAdController->searchAdsForLocation($postedAdLocationRequest);
    }

}
