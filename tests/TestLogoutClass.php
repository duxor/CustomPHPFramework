<?php

/**
 * Created by PhpStorm.
 * User: duXor
 * Date: 4/22/2017
 * Time: 16:18
 */

class TestLogoutClass extends LogoutController {
    protected function redirect(){
        return $this->redirectUrl;
    }
}