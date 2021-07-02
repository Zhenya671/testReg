<?php
class Router {
    private $routes;

    public function __construct() {

        $this->routes = include (CONFIG . '\routes.php');

    }

    public function run() {

        $uri = trim($_SERVER['REQUEST_URI'], '/');

        foreach ($this->routes as $uriPattern => $path) {
            if(preg_match("~$uriPattern~", $uri)) {
                $internalRoute =  preg_replace("~$uriPattern~", $path, $uri, 1);

                $segments = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segments)) . 'Controller';

                $actionName = 'action' . ucfirst(array_shift($segments));

                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();

                if ($result != null) {
                    break;
                }

            }
        }

    }
}