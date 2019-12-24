<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
//instead of render twig-views
    $container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../templates', [
       'cache' => false,
   ]);
   $view->addExtension(new \Slim\Views\TwigExtension(
       $container->router,
       $container->request->getUri()
   ));
   return $view;

    };
    // view renderer
  /*  $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };*/

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };
    //boot eloquent connection
/* $capsule = new \Illuminate\Database\Capsule\Manager;
 $capsule->addConnection($container['settings']['db']);
 $capsule->setAsGlobal();
 $capsule->bootEloquent();
 //pass the connection to global container (created in previous article)
 $container['db'] = function ($container) use ($capsule){
    return $capsule;
  }; */
    $container['db'] = function ($c) {
       try {
           $db = new PDO("sqlite:".__DIR__."/blog.db");
           $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         } catch (Exception $e) {
        echo $e->getMesssage();
     }
    return $db;
  };
};
