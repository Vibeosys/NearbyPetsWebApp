<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Dto;
use App\Model\Table;

/**
 * Description of UserController
 *
 * @author niteen
 */
class UserController extends ApiController{
    
    public function getTableObj() {
        return new Table\UserTable();
    }
    
    public function test() {
        $this->autoRender = FALSE;
        $data['code'] = 1;
        $data['msg'] = 'Route Access';
        $this->response->body(json_encode($data));
    }
    
    public function getUserProfile($email) {
        $result = $this->getTableObj()->getUser($email);
        if($result){
            return $this->prepareResponse($result);
        }
        return $this->prepareResponse(Dto\ErrorDto::prepareError(105));
    }
    public function login($credential) {
        $this->autoRender = FALSE;
           $pwd = $this->getTableObj()->getCredential($credential->email);
            if($credential->password == $pwd){
            
                return $this->getTableObj()->getUser($credential->email);
            }
            return FALSE;
    }
    
    public function register($register) {
        $this->autoRender = FALSE;
        if($this->getTableObj()->is_present($register->email)){
            return $this->prepareResponse(Dto\ErrorDto::prepareError(102));
        }
        $userId = $this->guidGenerator();
        $result = $this->getTableObj()->insert($userId, $register);
        if($result){
            $user = $this->getTableObj()->getUser($register->email);
            return $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(2, $user));
        }
        return $this->prepareResponse(Dto\ErrorDto::prepareError(103));
        
    }
    
    public function passwordRecovery($userMail) {
        $this->autoRender = FALSE;
         /*   
          $email = new Email();
          $email->to($userMail);
          $email->from('veerniteen@gmail.com');
          $email->subject('Password recovery');
           $email->template('forgot_password');
           $email->emailFormat('html');
          $email->set('password','123456');*/
        $subject = "Password recovery";
        $password =$this->getTableObj()->getCredential($userMail);
        if(!$password){
             return $this->prepareResponse(Dto\ErrorDto::prepareError(104));
        }
        $message = '<html><head>
                    <title>Forgot Password</title>
                    <style>*{margin:0;padding:0;font-family:"Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px}img{max-width:100%}body{-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width:100%!important;height:100%;line-height:1.6}table td{vertical-align:top}body{background-color:#f6f6f6}.body-wrap{background-color:#f6f6f6;width:100%}.container{display:block!important;max-width:600px!important;margin:0 auto!important;clear:both!important}.content{max-width:600px;margin:0 auto;display:block;padding:20px}.main{background:#fff;border:1px solid #e9e9e9;border-radius:3px}.content-wrap{padding:20px}.content-block{padding:0 0 20px}.header{width:100%;margin-bottom:20px}.footer{width:100%;clear:both;color:#999;padding:20px}.footer a{color:#999}.footer p,.footer a,.footer unsubscribe,.footer td{font-size:12px}.column-left{float:left;width:50%}.column-right{float:left;width:50%}h1,h2,h3{font-family:"Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;color:#000;margin:40px 0 0;line-height:1.2;font-weight:400}h1{font-size:32px;font-weight:500}h2{font-size:24px}h3{font-size:18px}h4{font-size:14px;font-weight:600}p,ul,ol{margin-bottom:10px;font-weight:normal}p li,ul li,ol li{margin-left:5px;list-style-position:inside}a{color:#348eda;text-decoration:underline}.btn-primary{text-decoration:none;color:#FFF;background-color:#348eda;border:solid #348eda;border-width:10px 20px;line-height:2;font-weight:bold;text-align:center;cursor:pointer;display:inline-block;border-radius:5px;text-transform:capitalize}.last{margin-bottom:0}.first{margin-top:0}.padding{padding:10px 0}.aligncenter{text-align:center}.alignright{text-align:right}.alignleft{text-align:left}.clear{clear:both}.alert{font-size:16px;color:#fff;font-weight:500;padding:20px;text-align:center;border-radius:3px 3px 0 0}.alert a{color:#fff;text-decoration:none;font-weight:500;font-size:16px}.alert.alert-warning{background:#ff9f00}.alert.alert-bad{background:#d0021b}.alert.alert-good{background:#68b90f}.invoice{margin:40px auto;text-align:left;width:80%}.invoice td{padding:5px 0}.invoice .invoice-items{width:100%}.invoice .invoice-items td{border-top:#eee 1px solid}.invoice .invoice-items .total td{border-top:2px solid #333;border-bottom:2px solid #333;font-weight:700}@media only screen and (max-width:640px){h1,h2,h3,h4{font-weight:600!important;margin:20px 0 5px!important}h1{font-size:22px!important}h2{font-size:18px!important}h3{font-size:16px!important}.container{width:100%!important}.content,.content-wrapper{padding:10px!important}.invoice{width:100%!important}}</style>
                    </head>
                    <body>
                    <table class="body-wrap">
                    <tbody><tr>
                    <td></td>
                    <td class="container" width="600">
                    <div class="content">
                    <table class="main" cellpadding="0" cellspacing="0" width="100%">
                    <tbody><tr>
                    <td class="alert alert-warning">
                    Password Recovery
                    </td>
                    </tr>
                    <tr>
                    <td class="content-wrap">
                    <table cellpadding="0" cellspacing="0" width="100%">
                    <tbody><tr>
                    <td class="content-block">
                    <strong>Near By Pets</strong> Password Recovery
                    </td>
                    </tr>
                    <tr>
                    <td class="content-block">
                    Your password is:-
                    </td>
                    </tr>
                    <tr>
                    <td class="content-block">
                    <p style="align:center">'.$password .'</p>
                    </td>
                    </tr>
                    <tr>
                    <td class="content-block">
                    Thanks..!
                    </td>
                    </tr>
                    </tbody></table>
                    </td>
                    </tr>
                    </tbody></table>
                    <div class="footer">
                    <table width="100%">
                    <tbody><tr>
                    <td class="aligncenter content-block"><a href="#">Near-by pets</a></td>
                    </tr>
                    </tbody></table>
                    </div></div>
                    </td>
                    <td></td>
                    </tr>
                    </tbody></table>
                    </body></html>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
          if(mail($userMail, $subject, $message,$headers)){
              return $this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(3,null));
          }
          return $this->prepareResponse(Dto\ErrorDto::prepareError(104));
       
    }
    
  
}
