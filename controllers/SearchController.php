<?php

/**
 * Class SearchController
 */

class SearchController extends User{
    /**
     * SearchController constructor.
     */
    public function __construct($search = null)
    {
        $search = $search ? $search : isset($_POST['search']) ? $_POST['search'] : "";
        $this->message = [];
        if ($this::isLogged())
        {
            $user = new User();
            $_SESSION["result"] = $user->search($search);
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