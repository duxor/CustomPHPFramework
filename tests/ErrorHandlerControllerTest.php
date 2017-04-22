<?php

/**
 * Created by PhpStorm.
 * User: duXor
 * Date: 4/20/2017
 * Time: 22:01
 */
use PHPUnit\Framework\TestCase;

/**
 * Class ErrorHandlerControllerTest
 *
 * @author Dusan Perisic
 */
class ErrorHandlerControllerTest extends TestCase {
    /**
     * @author Dusan Perisic
     */
    public function testGet()
    {
        $_SESSION['errors'] = [["Test error"]];
        $this->assertNotNull(ErrorHandlerController::get());

        $_SESSION['errors'] = null;
        $this->assertFalse(ErrorHandlerController::get());
    }
}
