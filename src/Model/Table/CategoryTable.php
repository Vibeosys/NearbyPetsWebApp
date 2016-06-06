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
use Cake\Datasource\ConnectionManager;

/**
 * Description of CategoryTable
 *
 * @author niteen
 */
class CategoryTable extends Table {

    public function connect() {
        return TableRegistry::get('category');
    }

    public function getAll() {
        $rows = $this->connect()->find();
        if ($rows->count()) {
            $category = array();
            $counter = 0;
            foreach ($rows as $row) {
                $category[$counter++] = new DownloadDto\CategoryDownloadDto(
                        $row->CategoryId, $row->CategoryDesc);
            }
            return $category;
        }
        return null;
    }

    public function getCategoryAdsList() {
        $name = "getCategoryAdList";
        $datasource = ConnectionManager::config('default');
        $connection = mysql_connect($datasource['host'], $datasource['username'], $datasource['password']);
        mysql_select_db($datasource['database'], $connection);
        $query = "call " . $name . "();";
        $result = mysql_query($query);
        //echo 'result from stored proce'.$result;
        $count = mysql_num_rows($result);
        $categoryAdList = array();
        $counter = 0;
        if (!is_bool($result)) {
            if ($count) {
                while ($procRecord = mysql_fetch_assoc($result)) {
                    $categoryRow = new DownloadDto\CategoryListDownloadDto();
                    $categoryRow->categoryId = $procRecord['CategoryId'];
                    $categoryRow->title = $procRecord['CategoryDesc'];
                    $categoryRow->image = $procRecord['CategoryImageUrl'];
                    $categoryRow->products = $procRecord['ProductCount'];
                    $categoryAdList[$counter++] = $categoryRow;
                }
            }
        }

        mysql_close($connection);
        return $categoryAdList;
    }

}
