<?php

/**
 * Class RouteController
 */
class Router {
    /**
     * @var string
     */
    private $root = "/index.php";
    /**
     * @var string
     */
    private $errorFile = "views/error.php";
    /**
     * @var string
     */
    private $route;

    /**
     * RouteController constructor.
     */
    public function __construct(){
        $this->route = substr($_SERVER['PHP_SELF'], strlen($this->root)+1);
        $this->isIndex();
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
            $this->getController();
        else
            $this->getView();
    }

    /**
     *
     */
    private function isIndex(){
        if ($this->route == "" || $this->route == "index")
        {
            $this->route = "home";
            $_SESSION['errors'] = [];
        }
    }

    /**
     *
     */
    private function getController()
    {
        $controller = ucfirst($this->route) . "Controller";
        require_once "controllers/" . $controller . ".php";
        new $controller();
    }

    /**
     *
     */
    private function getView()
    {
        $target = "views/{$this->route}.php";
        if (file_exists($target)){
            require_once $target;
        }
        else
        {
            require_once $this->errorFile;
        }
    }

    /**
     * @param $route
     */
    public static function redirect($route)
    {
        header("Location: {$route}");
    }
}