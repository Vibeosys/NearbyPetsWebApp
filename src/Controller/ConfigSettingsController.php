<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of ConfigSettingsController
 *
 * @author niteen
 */
class ConfigSettingsController extends Apicontroller{
    
    public function getTableObj() {
        return new Table\ConfigSettingsTable();
    }
    
    public function getConfigSettings() {
        return $this->getTableObj()->getSettings();
    }
    
    public function saveConfigSettings($settingArray = NULL){
        $result = true;
        foreach ($settingArray as $setting)
        {
             $result &= $this->getTableObj()->updateSettings($setting -> configKey, $setting -> configValue);   
        }
        return $result;
    }
}
