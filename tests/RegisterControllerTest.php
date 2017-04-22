<?php

/**
 * Created by PhpStorm.
 * User: duXor
 * Date: 4/20/2017
 * Time: 22:59
 */
use PHPUnit\Framework\TestCase;
require_once "LoginControllerTest.php";
require_once "TestRegisterClass.php";

class RegisterControllerTest extends TestCase {
    public function testIsRegistered($email = null, $password = null)
    {
        $email = $email ? $email : "admin@admin.com";
        $password = $password ? $password : "admin@admin.com";
        $login = new TestLoginClass($email, $password);
        $user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

        $errors = isset($_SESSION["errors"]) ? $_SESSION["errors"] : null;
        if ($errors)
        {
            $this->assertEquals("Error logging.", $errors[0]["login"]);
        }
        else
        {
            $this->assertNull($errors);
        }

        return $user ? true : false;
    }

    /**
     * @depends testIsRegistered
     */
    public function testUserRegistration(bool $isRegistered)
    {
        if ($isRegistered)
        {
            //ToDo: Insert logic for remove user from database.
            $this->assertFalse(false);
            return false;
        }
        else
        {
            $register = new TestRegisterClass("admin@admin.com", "Administrator", "admin@admin.com", "admin@admin.com");
            $this->assertEquals("/login", $register->redirect());
        }

        return true;
    }
    /**
     * @depends testUserRegistration
     */
    public function testRegistratedUser()
    {
        $login = new TestLoginClass("admin@admin.com", "admin@admin.com");
        $this->assertEquals("/home", $login->redirect());

        $user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;
        $this->assertNotNull($user);

        $errors = isset($_SESSION["errors"]) ? $_SESSION["errors"] : null;
        $this->assertNull($errors);

        //ToDo: Insert logic for remove user from database.
    }
}
