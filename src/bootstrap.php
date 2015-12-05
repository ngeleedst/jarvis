<?php

require __DIR__ . '/../app/autoload.php';

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

ErrorHandler::register();
if ('cli' !== php_sapi_name()) {
    ExceptionHandler::register();
}

use Silex\Application;
use Silex\Provider as Silex;
use Application\Provider as Home;
use Symfony\Component\Debug\Debug;;

$app = new Application($config);

$app->register(new Silex\DoctrineServiceProvider);
$app->register(new Silex\ServiceControllerServiceProvider);
$app->register(new Silex\LocaleServiceProvider);
$app->register(new Silex\TranslationServiceProvider);
$app->register(new Silex\FormServiceProvider);
$app->register(new Silex\DoctrineServiceProvider, $app['monolog.options']);


//$app->register(new MediaMonks\TwigServiceProvider, $app['twig.options']);
//$app->register(new MediaMonks\CacheServiceProvider);
$app->register(new \Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider, $app['orm.options']);
//$app->register(new Home\DoctrineOrmServiceProvider, $app['orm.options']);
//$app->register(new MediaMonks\DMSFilterServiceProvider);


return $app;