<?php

namespace App\Error;

use Cake\Error\BaseErrorHandler;
use Cake\Core\App;
use Exception;
use App\Controller;
use App\Dto;
use Cake\Network\Response;



class AppError extends BaseErrorHandler
{
    
      
    
    public function _displayError($error, $debug){
        $apiCOntroller = new Controller\Apicontroller();
        $errorObj = new Dto\ErrorDto();
        $errorObj->errorCode = 500;
        $errorObj->message = $error['description'];
        $response = $apiCOntroller->prepareResponse($errorObj,null);
        //return json_encode($response);
        //print_r($error);
        if($error['error'] == 'Fatal' or $error['error'] == 'Warning'){
        $responseObj = new Response();
         $responseObj->type('json');
         $responseObj->body($response);
         $responseObj->send();
        }
       
        //print_r($error);
    }
    public function _displayException($exception){
       
        $apiCOntroller = new Controller\Apicontroller();
        $errorObj = new Dto\ErrorDto();
        $errorObj->errorCode = 500;
        $errorObj->message = $exception;
        $responseCustomize = $apiCOntroller->prepareResponse($errorObj, NULL);
        //return json_encode();
         //$this->_sendResponse($responseCustomize);
         //return json_encode($responseCustomize);
         $responseObj = new Response();
         $responseObj->type('json');
         $responseObj->body($responseCustomize);
         $responseObj->send();
    }
    public function handleFatalError($code, $description, $file, $line)
    {
        $apiCOntroller = new Controller\Apicontroller();
        $errorObj = new Dto\ErrorDto();
        $errorObj->errorCode = 500;
        $errorObj->message = $description;
        $response = $apiCOntroller->prepareResponse($errorObj, NULL);
       // return json_encode($response);
       $responseObj = new Response();
         $responseObj->type('json');
         $responseObj->body($response);
         $responseObj->send();
    }
    
    public function handleException(\Exception $exception) {
         $apiCOntroller = new Controller\Apicontroller();
        $errorObj = new Dto\ErrorDto();
        $errorObj->errorCode = 500;
        $data = json_decode(json_encode($exception));
        $errorObj->message = $data->errorInfo[2];
        $response = $apiCOntroller->prepareResponse($errorObj, NULL);
        //  return json_encode($response);
        // $this->_sendResponse($response);
        //parent::handleException($exception);
        //$data = explode(' ', $exception, 1);
         $responseObj = new Response();
         $responseObj->type('json');
         //$this->response->type('json');

    //$json = json_encode(array('message'=>'GET request not allowed!'));
        $responseObj->body($response);
        $responseObj->send();
        //print_r($response);
        //echo json_encode($exception);
    }
}