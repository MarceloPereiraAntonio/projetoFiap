<?php

namespace App\Core;

class Route
{
    private static array $routes = [];

    public static function get(string $uri, array $action)
    {
        self::addRoute('GET', $uri, $action);
    }

    public static function post(string $uri, array $action)
    {
        self::addRoute('POST', $uri, $action);
    }

    public static function put(string $uri, array $action)
    {
        self::addRoute('PUT', $uri, $action);
    }

    public static function delete(string $uri, array $action)
    {
        self::addRoute('DELETE', $uri, $action);
    }

    private static function addRoute(string $method, string $uri, array $action)
    {
        $regex = '#^' . preg_replace('/\{[^\}]+\}/', '([^/]+)', $uri) . '$#';
        self::$routes[$method][$regex] = $action;
    }

    public static function middleware(string $name, \Closure $callback)
    {
        if ($name === 'auth' && !isset($_SESSION['user'])) {
            // Evita proteger a própria página de login
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            if ($uri !== '/login') {
                header('Location: /login');
                exit;
            }
        }

        $callback();
    }

    public static function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        // Suporte a PUT e DELETE via _method
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        foreach (self::$routes[$method] ?? [] as $pattern => $action) {
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                [$controller, $method] = $action;
                (new $controller)->$method(...$matches);
                return;
            }
        }

        http_response_code(404);
        echo "404 - Página não encontrada";
    }
}
