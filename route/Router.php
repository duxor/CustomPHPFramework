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
    public function __construct($route = null)
    {
        $this->setRoute($route ? $route : trim($_SERVER['REQUEST_URI'], '/'));
        $this->getTarget();
    }

    /**
     * @param string $route
     */
    public function setRoute( string $route ){
        $this->route = $route;
    }

    /**
     * @author Dusan Perisic
     */
    private function getTarget()
    {
        $this->isIndex();
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $controller = $this->getController();
            $_SERVER['REQUEST_METHOD'] = "GET";
            $this->redirect($controller->getRedirectUrl());
        }
        else
            $this->getView();
    }

    /**
     *
     */
    private function isIndex()
    {
        if ($this->route == "" || $this->route == "/" || $this->route == "index")
        {
            $this->route = "home";
            $_SESSION['errors'] = [];
        }
    }

    /**
     * @return bool
     * @author Dusan Perisic
     */
    private function isLogged()
    {
        if (substr($this->route, strlen($this->route) - 5) == "login")
        {
            if (User::isLogged())
            {
                $this->route = "/home";
                return true;
            }
        }
        return false;
    }

    /**
     * @return string
     * @author Dusan Perisic
     */
    private function renderRouteName()
    {
        return $this->route[0] == "/" || $this->route[0] == "\\" ? substr($this->route, 1) : $this->route;
    }
    /**
     *
     */
    private function getController()
    {
        $controller = ucfirst($this->renderRouteName()) . "Controller";
        require_once "controllers/" . $controller . ".php";
        return new $controller();
    }

    /**
     *
     */
    private function getView()
    {
        $this->isLogged();
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
        $router = new Router($route);
        $router->getTarget();
    }
}