<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Dto\DownloadDto;

/**
 * Description of Apicontroller
 *
 * @author niteen
 */
class Apicontroller extends AppController {

    public $apiOperation = [
        'PL' => 'ProductList',
        'PLI' => 'ProductListIos',
        'UL' => 'UserLogin',
        'UR' => 'UserRegistration',
        'CL' => 'CategoryList',
        'FP' => 'ForgotPassword',
        'GC' => 'GetCategory',
        'GT' => 'GetTypes',
        'GP' => 'GetProfile',
        'SS' => 'SaveSettings',
        'PA' => 'PostAd',
        'SAA' => 'SaveAnAd',
        'RSA' => 'RemoveSavedAd',
        'GSA' => 'GetSavedAd',
        'GSAI' => 'GetSavedAdIos',
        'CPA' => 'ClassifiedAds',
        'CPAI' => 'ClassifiedAdsIos',
        'MPA' => 'MyPostedAds',
        'MPAI' => 'MyPostedAdsIos',
        'HP' => 'HidePost',
        'DP' => 'DisablePost',
        'SOP' => 'SoldOutPost',
        'CS' => 'ChangeStatus',
        'PD' => 'ProductDescription',
        'PDI' => 'ProductDescriptionIos',
        'GHA' => 'GetHiddenAds',
        'GHAI' => 'GetHiddenAdsIos',
        'UUR' => 'UpdateUserRadius',
        'UHP' => 'UnHidePost',
        'UPU' => 'UserProfileUpdate'
    ];
    
    public $postedAdStatus = [
        '1' => 'Sold Out' ,
        '2' => 'Disabled' ,
        '3' => 'Hidden' 
    ];
    
    public $sortOpetions = [
        '0' => 'PostedDate',
        '1' => 'Distance',
        '2' => 'Price'
    ];

    public function initialize() {
        parent::initialize();
        $this->response->type('json');
    }

    public function prepareResponse($error, $data) {
        // error code 500 for database exception 
        $configController = new ConfigSettingsController();
        $settings = $configController->getConfigSettings();
        if(!is_null($data))
            $data = json_encode($data);
        if($error->errorCode == 500 or $error->errorCode == 404)
        $result = new DownloadDto\ResponseDto(null, $data, $error);
        else
        $result = new DownloadDto\ResponseDto($settings, $data, $error);    
        return json_encode($result);
    }

    public function guidGenerator() {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = substr($charid, 0, 8) . $hyphen
                    . substr($charid, 8, 4) . $hyphen
                    . substr($charid, 12, 4) . $hyphen
                    . substr($charid, 16, 4) . $hyphen
                    . substr($charid, 20, 12);
                    //. chr(125); // "}"
            return $uuid;
        }
    }
    
    public function getExtension($fileName) {
        return end((explode('.', $fileName)));
    }
    
    public function productListIosConvertor($productList) {
        $counter = 0;
        $IosList = array();
        foreach ($productList as $product){
            $IosList[$counter++] = new DownloadDto\ProductListIosDto(
                    $product->name, 
                    $product->description, 
                    $product->price, 
                    $product->distance, 
                    $product->image, 
                    $product->adid, 
                    $product->postedDate);
            
        }
        return $IosList;  
    }

}
