<?php
namespace App\Dto;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClsErrorDto
 *
 * @author niteen
 */
class ErrorDto {
    
    public $errorCode;
    public $message;


    //format {"errorCode":"100", "message":"User is not authenticated"}
    public static function prepareError($errorcode) {
        
        $errorDto = new ErrorDto();
        $errorDto->errorCode = $errorcode;
        $errorDto->message = $errorDto->errorDictionary[$errorcode];
        $error[0] = $errorDto;
        return $error;//json_encode($error);
    }
    
     public static function prepareSuccessMessage($successCode) {
        
        $errorDto = new ErrorDto();
        $errorDto->errorCode = 0;
        $errorDto->message = $errorDto->SuccessDictionary[$successCode];
        $error[0] = $errorDto;
        return $error;//json_encode($error);
    }
    
    protected $errorDictionary = [
        404 => 'You are not autorised',
        101 => 'Login Failed',
        102 => 'Sorry..!Duplicate email.',
        103 => 'Sorry..!Registration Failed.',
        104 => 'Invalid request',
        105 => 'Error to Place order',
        106 => 'Orders Not FulFilled for requested customer',
       ];
    protected $SuccessDictionary = [
        1 => 'Login Success',
        2 => 'Congrasts..!You are register with us.',
        3 => 'UserId not found in database or RestaurantId not valid',
        4 => 'Update not found',
        5 => 'Invalid request',
        6 => 'Error to Place order',
        7 => 'Orders Not FulFilled for requested customer',
       ];
    
}
