<?php
error_reporting(E_ALL & ~E_NOTICE); // or simply error_reporting(~E_NOTICE);
date_default_timezone_set('Europe/Amsterdam');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug;

//umask(0000);


/**
 * @var Composer\Autoload\ClassLoader $loader
 */
$loader = require __DIR__.'/../app/autoload.php';

require_once __DIR__.'/../app/MicroKernel.php';

Debug\Debug::enable();

$kernel = new MicroKernel('dev', true);
$kernel->loadClassCache();

$request    = Request::createFromGlobals();
$response   = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
