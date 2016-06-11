<?php

namespace App\Model\Table;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ActivateModel
 *
 * @author niteen
 */
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\Dto;
use App\Dto\DownloadDto;
use PDOException;

class UserTable extends Table {

    public function connect() {
        return TableRegistry::get('user');
    }

    public function is_present($email = null, $fb_token = null) {

        if (is_null($email)) {
            $conditions = [
                'FbApiToken' => $fb_token
            ];
        } else {
            $conditions = [
                'UserEmail' => $email
            ];
        }
        try {
            $data = $this->connect()->find()->where($conditions);
            if ($data->count()) {
                return true;
            }
            return FALSE;
        } catch (Exception $e) {
            trigger_error('Database error');
        }
    }

    public function getCredential($email) {
        $conditions = [
            'UserEmail' => $email, 
            'LoginSource' => NORMAL_LOGIN
            ];
        $data = $this->connect()->find()->where($conditions);
        if ($data->count()) {
            foreach ($data as $row) {
                $result = $row->Pwd;
            }
            return $result;
        }
        return FALSE;
    }

    public function insert($userId, $register) {
        $Obj = $this->connect();
        $newEntity = $Obj->newEntity();
        $newEntity->UserId = $userId;
        $newEntity->UserEmail = $register->email;
        $newEntity->Pwd = $register->password;
        $newEntity->FirstName = $register->fname;
        $newEntity->LastName = $register->lname;
        $newEntity->Phone = $register->phone;
        $newEntity->LoginSource = $register->source;
        $newEntity->FbApiToken = $register->token;
        $newEntity->CreatedDate = date(DATE_TIME_FORMAT);
        $newEntity->RoleId = APP_CUSTOM_USER;
        $newEntity->Active = 1;
        if ($Obj->save($newEntity)) {
            return true;
        }
        return FALSE;
    }

    public function updateFbUserToken($email, $token) {
        $key = [
            'FbApiToken' => $token
        ];
        $conditions = [
            'UserEmail =' => $email
        ];
        $update = $this->connect()->query()->update();
        $update->set($key);
        $update->where($conditions);
        if ($update->execute()) {
            return true;
        }
        return FALSE;
    }

    public function getUser($email) {
        $conditions = ['UserEmail' => $email];
        try {
            $data = $this->connect()->find()->where($conditions);
        } catch (PDOException $ex) {
            return FALSE;
        }
        if ($data->count()) {
            foreach ($data as $row) {
                $result = new DownloadDto\UserProfileDownloadDto(
                        $row->FirstName, 
                        $row->LastName, 
                        $row->UserEmail, 
                        $row->Phone, 
                        $row->UserId, 
                        $row->RoleId, 
                        $row->Pwd, 
                        $row->FbApiToken);
            }
            return $result;
        }
        return FALSE;
    }

    public function checkCredentialsWithRole($email, $pwd, $roleId) {
        $conditions = [
            'UserEmail' => $email, 
            'Pwd' => $pwd, 
            'RoleId' => $roleId, 
            'Active' => 1];
        $data = $this->connect()->find()->where($conditions);
        if ($data->count()) {
            return true;
        }
        return FALSE;
    }

    public function checkValidFbUser($token, $role) {
        $conditions = [
            'FbApiToken' => $token, 
            'RoleId' => $role, 
            'Active' => 1];
        $data = $this->connect()->find()->where($conditions);
        if ($data->count()) {
            return true;
        }
        return FALSE;
    }

}
