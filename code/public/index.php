<?php

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

include_once __DIR__ . '/../conifg/bootstrap.php';

$app = new Slim\App();

$container = $app->getContainer();

$container['view'] = function (Container $c)
{
    $view = new \Slim\Views\Twig(__DIR__ . '/../templates', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

$app->get('/', function (Request $request, Response $response, $args) {
   return $this->get('view')->render($response, 'index.html.twig');
});


$app->run();