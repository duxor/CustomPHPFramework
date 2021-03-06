<?php

/**
 * Created by PhpStorm.
 * User: duXor
 * Date: 4/20/2017
 * Time: 22:59
 */

use PHPUnit\Framework\TestCase;
require_once "controllers/LoginController.php";

/**
 * Class LoginControllerTest
 *
 * @author Dusan Perisic
 */
class LoginControllerTest extends TestCase {
    /**
     * @author Dusan Perisic
     */
    public function testEmailIsNotRegistrated()
    {
        $login = new LoginController("errormail@error.mail", "errormail@error.mail");
        $this->assertEquals("/login", $login->getRedirectUrl());

        $user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;
        $this->assertNull($user);

        $errors = isset($_SESSION["errors"]) ? $_SESSION["errors"] : null;
        $this->assertEquals("Error logging.", $errors[0]["login"]);
    }

    /**
     * @author Dusan Perisic
     */
    public function testErrorEmailFormat()
    {
        $login = new LoginController("errormail", "errormail@error.mail");
        $this->assertEquals("/login", $login->getRedirectUrl());

        $user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;
        $this->assertNull($user);

        $errors = isset($_SESSION["errors"]) ? $_SESSION["errors"][0]["email"] : null;
        $this->assertEquals("Email is not valid.", $errors);
    }

    /**
     * @author Dusan Perisic
     */
    public function testErrorPasswordLength()
    {
        $login = new LoginController("errormail@error.mail", "12");
        $this->assertEquals("/login", $login->getRedirectUrl());

        $user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;
        $this->assertNull($user);

        $errors = isset($_SESSION["errors"]) ? $_SESSION["errors"][0]["password"] : null;
        $this->assertEquals("Password is not valid. Min length is 5.", $errors);
    }
}