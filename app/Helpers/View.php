<?php

namespace App\Helpers;

class View
{
    public static function render(string $view, array $data = [], bool $useLayout = true)
    {
        extract($data);
        $viewPath = __DIR__ . '/../Views/' . str_replace('.', '/', $view) . '.php';
    
        if (!file_exists($viewPath)) {
            echo "View '{$view}' não encontrada.";
            return;
        }
    
        if ($useLayout) {
            $layout = realpath(__DIR__ . '/../Views/layouts/main.php');
            if ($layout) {
                $viewFile = $viewPath;
                require $layout;
                return;
            }
        }
        require $viewPath;
    }
    
}