<?php

/**
 * Created by PhpStorm.
 * User: duXor
 * Date: 4/22/2017
 * Time: 16:17
 */
require_once "controllers/LoginController.php";

class TestLoginClass extends LoginController {
    public function redirect(){
        return $this->redirectUrl;
    }
}