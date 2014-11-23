<?php

//-------------------------------
// BOOTSTRAP
//-------------------------------

require_once __DIR__.'/../vendor/autoload.php'; 

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');

$twig = new Twig_Environment($loader);

$app = new Silex\Application(); 
//$app['debug'] = true;


//-------------------------------
// LOGIC
//-------------------------------

$file = ['../lib/dictionary/noun.txt','../lib/dictionary/verb.txt'][$termOrder = mt_rand(0,1)];

$file = file_get_contents($file);
$terms = explode("\n",$file);
$term = ucfirst($terms[mt_rand(0,count($terms))]);

$phrase = $termOrder ? 'Mage' . $term : $term . 'Gento';



//-------------------------------
// ROUTES
//-------------------------------

$app->get('/', function() use ($app, $twig, $phrase) {
	return $twig->render('index.html',array('phrase'=>$phrase));
}); 

$app->get('/get/phrase',function() use ($app, $twig, $phrase) {
	$social = $twig->render('social.html',array('phrase'=>$phrase));
	return json_encode(array('phrase'=>$phrase, 'social'=>$social));
});

//-------------------------------
// UP UP AND AWAY
//-------------------------------

$app->run();