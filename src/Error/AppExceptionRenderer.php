<?php
namespace App\Error;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Cake\Error\ExceptionRenderer;
use App\Error;
/**
 * Description of AppExceptionRenderer
 *
 * @author niteen
 */
class AppExceptionRenderer extends ExceptionRenderer{
    public function missingWidget($error)
    {
        return 'Oops that widget is missing!';
    }
}
