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
        'GSA' => 'GetSavedAd',
        'CPA' => 'ClassifiedAds',
        'HP' => 'HidePost',
        'DP' => 'DisablePost',
        'SOP' => 'SoldOutPost',
        'CS' => 'ChangeStatus',
        'PD' => 'ProductDescription'
    ];
    
    public $postedAdStatus = [
        'SoldOut' => '1' ,
        'Disabled' => '2',
        'Hidden' => '3'
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

    public function prepareResponse($data) {
        $configController = new ConfigSettingsController();
        $settings = $configController->getConfigSettings();
        $result = new DownloadDto\ResponseDto($settings, $data);
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

}
