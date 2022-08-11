<?php
namespace App\Views;

use App\Controllers\Controller;

class Router {
    private static $routers = [];

    const METHOD_GET = "GET";
    const METHOD_POST = "POST";

    private static function addHandler($path, $method, $handler){
        static::$routers[$path.$method] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public static function get($path, $handler){
        static::addHandler($path, self::METHOD_GET, $handler);
    }

    public static function post($path, $handler){
        static::addHandler($path, self::METHOD_POST, $handler);
    }

    public static function run() {
        $requestURI = parse_url($_SERVER['REQUEST_URI']);
        $url = $requestURI['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;

        foreach (static::$routers as $handler){
            if ($url === $handler['path'] && $method === $handler['method']) {
                $callback = $handler['handler'];
            }
        }

        if(!$callback) {
            Controller::viewNotFound('404');
            return;
        }

        if(is_callable($callback)) {
            return $callback();
        }

        if(is_array($callback)) {
            [$class, $method] = $callback;
            $class = new $class;
            return call_user_func_array([$class, $method], []);
        }
    }
}

?>