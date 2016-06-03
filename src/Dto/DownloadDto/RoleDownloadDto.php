<?php
namespace App\Dto\DownloadDto;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RoleDownloadDto
 *
 * @author niteen
 */
class RoleDownloadDto {
   
    public $roleId;
    public $role;
    
    public function __construct($roleId = null, $role=null) {
        $this->roleId = $roleId;
        $this->role = $role;
    }
}
