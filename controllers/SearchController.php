<?php

/**
 * Class SearchController
 */

class SearchController extends User{
    /**
     * SearchController constructor.
     */
    public function __construct(){

        if ($this::isLogged())
        {
            $user = new User();
            $this->message = [];
            $_SESSION["result"] = $user->search($_POST['search']);
            $this->redirectUrl = "/search";
        }
        else
        {
            array_push($this->message, ["login" => "Please login"]);
            $this->redirectUrl = "/login";
        }
        $this->setMessage();
    }
}