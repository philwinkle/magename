<?php

require_once __DIR__.'/../vendor/autoload.php'; 

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');

$twig = new Twig_Environment($loader);

$app = new Silex\Application(); 

$app['debug'] = true;

$app->get('/', function() use ($app, $twig) {
	return $twig->render('index.html');
}); 

$app->run();