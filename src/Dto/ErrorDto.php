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
   // public $data;
    //public $settings;


    //format {"errorCode":"100", "message":"User is not authenticated"}
    public static function prepareError($errorcode) {
        
        $errorDto = new ErrorDto();
        $errorDto->errorCode = $errorcode;
        $errorDto->message = $errorDto->errorDictionary[$errorcode];
       // $errorDto->data = null;
        $error = $errorDto;
        return $error;//json_encode($error);
    }
    
     public static function prepareSuccessMessage($successCode) {
        
        $errorDto = new ErrorDto();
        $errorDto->errorCode = 0;
        $errorDto->message = $errorDto->SuccessDictionary[$successCode];
      //  $errorDto->data = $data;
        $error = $errorDto;
        return $error;//json_encode($error);
    }
    
    protected $errorDictionary = [
        404 => 'You are not autorised',
        101 => 'Login Failed',
        102 => 'Sorry..!Duplicate email.',
        103 => 'Sorry..!Registration Failed.',
        104 => 'Email id invalid, it does not exist in our record',
        105 => 'Error to find profile.',
        106 => 'Error to change Ad status.',
        107 => 'Configurations could not be saved.',
        108 => 'User is not authorised for this transaction',
        109 => 'Error in Ad posting.',
        110 => 'Error in save Ad.',
        111 => 'Ads not found.',
        112 => 'data not found.'
       ];
    protected $SuccessDictionary = [
        1 => 'Login Success',
        2 => 'Congrasts..!You are register with us.',
        3 => 'Please check your mail box..!',
        4 => 'Ad status chnaged.',
        5 => 'Invalid request',
        6 => 'Error to Place order',
        7 => 'Orders Not FulFilled for requested customer',
        8 => 'Configurations saved successfully',
        9 => 'Your ad posted successfully.',
        10 => 'Your ad set as Favourite successfully.',
        11 => 'Ad found.',
        12 => 'categories are found.',
        13 => 'Types are found.',
        14 => 'Requested profile found.'
       ];
    
}
