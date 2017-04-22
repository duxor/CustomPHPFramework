<?php

/**
 * Class SearchController
 */
class SearchController extends DB{
    /**
     * SearchController constructor.
     */
    public function __construct(){

        if (User::isLogged())
        {
            $user = new User();
            $_SESSION["errors"] = null;
            $_SESSION["result"] = $user->search($_POST['search']);
            Router::redirect('/search');
        }
        else
        {
            $_SESSION["errors"] = [
                ["login" => "Please login"]
            ];
            Router::redirect('/login');
        }
    }
}