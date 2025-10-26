<?php

header('Content-Type: text/html; charset=UTF-8');

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/Controllers/BlogController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$path = parse_url($request, PHP_URL_PATH);

$basePath = '/php-project';
if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}

$path = ltrim($path, '/');

$segments = explode('/', $path);

$controller = new BlogController();

switch ($segments[0]) {
    case '':
    case 'index.php':
        $controller->index();
        break;

    case 'create':
        $controller->create();
        break;

    case 'show':
        if (isset($segments[1]) && is_numeric($segments[1])) {
            $controller->show($segments[1]);
        } else {
            header('Location: /php-project/');
            exit;
        }
        break;

    case 'edit':
        if (isset($segments[1]) && is_numeric($segments[1])) {
            $controller->edit($segments[1]);
        } else {
            header('Location: /php-project/');
            exit;
        }
        break;

    case 'delete':
        if (isset($segments[1]) && is_numeric($segments[1])) {
            $controller->delete($segments[1]);
        } else {
            header('Location: /php-project/');
            exit;
        }
        break;

    case 'image':
        if (isset($segments[1]) && is_numeric($segments[1])) {
            $controller->showImage($segments[1]);
        } else {
            http_response_code(404);
            exit('Image not found');
        }
        break;

    default:
        http_response_code(404);
        echo '<h1>404 - Page Not Found</h1>';
        echo '<p><a href="/php-project/">Go back to home</a></p>';
        break;
}
