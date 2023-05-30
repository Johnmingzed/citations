<?php

namespace Core;

class Routeur
{

    public function __construct()
    {
        $this->rewriteUri();
        $this->init();
    }

    /**
     * Réécrit l'URI de la requête et effectue une redirection si nécessaire.
     *
     * @return void
     */
    public function rewriteUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        // Vérifie si l'URI se termine par un slash et si elle n'est pas vide ni égale à '/'
        if ($uri[-1] == '/' && !empty($uri) && $uri != '/') {
            $uri = substr($uri, 0, -1);
            http_response_code(301);
            header('Location: ' . $uri);
        }
    }

    public function init()
    {
        session_start();
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
            // unset($_SESSION['token']);
        }
        $route = explode('/', $_GET['req']);

        $controller = array_shift($route);

        if ($controller === '') {
            (new \App\Citation\CitationController)->index();
        } else {
            $controllerName = '\App\\' . ucfirst($controller) . '\\' .  ucfirst($controller) . 'Controller';
            $method = array_shift($route);
            $method = is_null($method) ? 'index' : $method;
            $params = $route === null ? '' : $route;
            if (method_exists($controllerName, $method)) {
                $controller = new $controllerName;
                $controller->$method($params);
            } else {
                http_response_code(404);
                die('Mauvaise route');
            }
        }
    }
}
