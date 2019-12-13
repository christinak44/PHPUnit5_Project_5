<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        $args = array_merge($args, $request->getEntries());
        //$args['post'] = $this->db;
        return $this->renderer->render($response, 'Blog_Home.phtml', $args);
    });
};
