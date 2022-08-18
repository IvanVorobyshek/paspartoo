<?php

namespace Project\Services;

use Project\Services\Config;

class Routes
{
    static function Routing()
    {
        $routes = Config::ROUTES;
        $route = $_REQUEST['route'] ?? '';
        $isRouteFound = false;
        foreach ($routes as $pattern => $controllerAndAction) {
            preg_match($pattern, $route, $matches);
            if (!empty($matches)) {
                $isRouteFound = true;
                break;
            }
        }

        if (!$isRouteFound) {
            echo 'Page not found!';
            return;
        }

        unset($matches[0]);

        $controller = new $controllerAndAction[0]();
        $actionName = $controllerAndAction[1];
        $controller->$actionName(...$matches);
        return;
    }
}
?>