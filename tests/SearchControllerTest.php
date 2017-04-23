<?php

/**
 * Created by PhpStorm.
 * User: duXor
 * Date: 4/20/2017
 * Time: 23:00
 */
use PHPUnit\Framework\TestCase;
require_once "controllers/SearchController.php";

class SearchControllerTest extends TestCase {
    public function testUserLogout()
    {
        $logout = new LogoutController();
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        $this->assertNull($user);
        return false;
    }

    /**
     * @author Dusan Perisic
     * @depends testUserLogout
     */
    public function testUserNotLogged(bool $isUserLogged)
    {
        $search = new SearchController();
        if (!$isUserLogged)
        {
            $this->assertEquals("/login", $search->getRedirectUrl());
            $this->assertEquals("Please login", $_SESSION["errors"][0]["login"]);
        }
        else
        {
            $this->assertEquals("/search", $search->getRedirectUrl());
            $this->assertNotNull($_SESSION["results"] ? $_SESSION["results"] : null);
        }
    }

    //ToDo: Add tests for logged users.
}