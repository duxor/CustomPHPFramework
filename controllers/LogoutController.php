<?php

/**
 * Class LogoutController
 */
class LogoutController extends User{
    /**
     * LogoutController constructor.
     */
    public function __construct(){
        $_SESSION['user'] = null;
        $_SESSION["errors"] = null;
        $this->redirectUrl = "/";

        return $this->redirect();
    }
}