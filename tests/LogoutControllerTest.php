<?php

/**
 * Created by PhpStorm.
 * User: duXor
 * Date: 4/20/2017
 * Time: 23:00
 */
use PHPUnit\Framework\TestCase;
require_once "controllers/LogoutController.php";
require_once "TestLogoutClass.php";

class LogoutControllerTest extends TestCase {
    public function testGet()
    {
        $logout = new TestLogoutClass();
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        $this->assertNull($user);
    }
}