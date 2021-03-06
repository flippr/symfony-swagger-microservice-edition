<?php
/*
 * This file is part of the kleijnweb/symfony-swagger-microservice-edition package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../app/AppKernel.php";

use Symfony\Component\HttpFoundation\Request;
use Dotenv\Dotenv;

$dotenv = new Dotenv(__DIR__ . '/../');
$dotenv->load();

// Some old school PHP does the trick fast and predictable
$requestUri = $_SERVER['REQUEST_URI'];
if (0 === strpos($requestUri, '/swagger/')) {
    $version = $_ENV['VERSION'];
    if ($requestUri === "/swagger/$version") {
        if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] === $version) {
            header('Content-Length: 0', null, 304);
            exit;
        }
        $path = __DIR__ . '/../app/config/swagger.yml';
        header('Content-Type: text/yml;charset=UTF-8');
        header('Content-Length: ' . filesize($path));
        header("ETag: $version");
        readfile($path);
        exit;
    }
    header('Content-Length: 0', null, 404);
    exit;
}

if (0 === strpos($_SERVER['SERVER_SOFTWARE'], 'PHP ')) {
    // Built-in server: assuming dev
    $dotenv->overload();
}

$request = Request::createFromGlobals();
$kernel = new AppKernel($_SERVER['SYMFONY_ENV'], (bool)$_SERVER['SYMFONY_DEBUG']);
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
