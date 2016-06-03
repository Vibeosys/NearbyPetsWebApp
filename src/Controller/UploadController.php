<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Dto\UploadDto;
use App\Dto\DownloadDto;
use App\Dto;
/**
 * Description of UploadController
 *
 * @author niteen
 */
class UploadController extends Apicontroller{
    
    public function divideWork() {
        $this->autoRender = FALSE;
        if($this->request->is('post')){
            $request = $this->request->input();
            $requestEncode = UploadDto\RequestDto::Deserialize($request);
            //$requestData = UploadDto\RequestDataDto::Deserialize($requestEncode->data);
            foreach ($requestEncode->data as $row){
            switch ($row->operation){
                
                case $this->apiOperation['PL']:
                    $data[0] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[1] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[2] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[3] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[4] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[5] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[6] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[7] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[8] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[9] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[10] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[11] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[12] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[13] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[14] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[15] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[16] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[17] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[18] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[19] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $data[20] = new DownloadDto\ProductListDownloadDto("parret", 'He can Talk', 20, 5, 'http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                    $response = $this->prepareResponse($data);
                    $this->response->body($response);
                    break;
                   
                case $this->apiOperation['PD']:
                   $pet[0] = new DownloadDto\PetDownloadDto("dog", 200, 'black color'); 
                  // $pet[1] = new DownloadDto\PetDownloadDto("dog", 200, 'black color'); 
                   //$pet[2] = new DownloadDto\PetDownloadDto("dog", 200, 'black color'); 
                   $seller[0] = new DownloadDto\SellerDownloadDto("mark", 9922334455, "mark@gmail.com");
                   //$seller[1] = new DownloadDto\SellerDownloadDto("mark", 9922334455, "mark@gmail.com");
                   //$seller[2] = new DownloadDto\SellerDownloadDto("mark", 9922334455, "mark@gmail.com");
                   $details[0] = new DownloadDto\AdDetailsDownloadDto('23/05/2016', 4, 3);
                   //$details[1] = new DownloadDto\AdDetailsDownloadDto('23/05/2016', 4, 3);
                   //$details[2] = new DownloadDto\AdDetailsDownloadDto('23/05/2016', 4, 3);
                   $images[0] = new DownloadDto\SliderImagesDownloadDto('http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                   $images[1] = new DownloadDto\SliderImagesDownloadDto('http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                   $images[2] = new DownloadDto\SliderImagesDownloadDto('http://www.sciencemag.org/sites/default/files/styles/article_main_medium/public/images/60603W_Dogs.jpg');
                   foreach ($pet as $key => $value){
                       $data[$key] = new DownloadDto\ProductDesciptionDownloadDto($value, $seller[$key], $details[$key], $images);
                   } 
                    $response = $this->prepareResponse($data);
                    $this->response->body($response);
                   break;
                   case $this->apiOperation['UL']:
                       $credential = UploadDto\LoginUploadDto::Deserialize($row->operationData);
                       $userController = new UserController();
                       $result = $userController->login($credential);
                       if($result){
                           $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareSuccessMessage(1)));
                       }  else {
                           $this->response->body($this->prepareResponse(Dto\ErrorDto::prepareError(101)));
                       }
                       break;
                   case $this->apiOperation['CL']:
                       $category[0] = new DownloadDto\CategoryListDownloadDto("Parret", 20, 'animals.sandiegozoo.org/sites/default/files/styles/square_thumbnail/public/bowerbird_thumb.jpg'); 
                       $category[1] = new DownloadDto\CategoryListDownloadDto("sparrow", 20, 'animals.sandiegozoo.org/sites/default/files/styles/square_thumbnail/public/bowerbird_thumb.jpg'); 
                       $category[2] = new DownloadDto\CategoryListDownloadDto("Dog", 20, 'animals.sandiegozoo.org/sites/default/files/styles/square_thumbnail/public/bowerbird_thumb.jpg'); 
                         $response = $this->prepareResponse($category);
                    $this->response->body($response);
                       break;
                    case $this->apiOperation['UR']:
                        $register = UploadDto\RegistrationUploadDto::Deserialize($row->operationData);
                         $userController = new UserController();
                        $result = $userController->register($register);
                        $this->response->body($result);
                        break;
            }
            }
        }
    }
    
    
    private function register($register) {
        $userController = new UserController();
        return $userController->register($register);
    }
}
