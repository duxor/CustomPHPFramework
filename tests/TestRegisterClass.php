<?php

/**
 * Created by PhpStorm.
 * User: duXor
 * Date: 4/22/2017
 * Time: 17:11
 */
require_once "controllers/RegisterController.php";

class TestRegisterClass extends RegisterController {
    public function redirect(){
        return $this->redirectUrl;
    }
}