<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\Dto\DownloadDto;
/**
 * Description of ConfigSettingsTable
 *
 * @author niteen
 */
class ConfigSettingsTable  extends Table{
    
    public function connect() {
        return TableRegistry::get('config_settings');
    }
    
    public function getSettings() {
        
        $rows = $this->connect()->find();
        if($rows->count()){
            $settings = array();
            $counter = 0;
            foreach ($rows as $row){
                $settings[$counter++] = new DownloadDto\ConfigSettingsDownloadDto
                        ($row->ConfigKey, $row->ConfigValue);
            }
            return $settings;;
        }else{
            return FALSE;
        }
    }
    
    public function updateSettings($configKey, $configValue)
    {
        $configSetttingDb = $this->get($configKey);
        $configSetttingDb -> $configValue = $configValue;
        $this->save($configSetttingDb);
        return $result;
    }
}
