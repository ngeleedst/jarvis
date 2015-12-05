<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\HttpFoundation\Request;

$loader = require __DIR__ . '/../vendor/autoload.php';

AnnotationRegistry::registerLoader([$loader, 'loadClass']);
AnnotationRegistry::registerAutoloadNamespace('JMS\Serializer\Annotation', __DIR__ . '/../vendor/jms/serializer/src');
AnnotationRegistry::registerAutoloadNamespace('DMS\Filter\Rules', __DIR__ . '/../vendor/dms/dms-filter/src');

$request = Request::createFromGlobals();

if (!defined('HTTP_BASE')) {

    $httpBase = sprintf('%s://%s%s/', $request->getScheme(), $request->getHost(), $request->getBasePath());

    $httpBase = str_replace('share/', '', $httpBase);
    $httpBase = str_replace('vGLFK31ptrPfhAR/', '', $httpBase);
    $httpBase = str_replace('api/', '', $httpBase);

    define('HTTP_BASE', $httpBase);
}

require_once __DIR__ . '/polyfill.php';
require_once __DIR__ . '/environment.php';

date_default_timezone_set('UTC');

$config = require __DIR__ . '/config/config.php';

//if (APPLICATION_ENV !== ENV_PRODUCTION) {
//    //$configEnv = require __DIR__ . sprintf('/config/config_%s.php', APPLICATION_ENV);
//    $config    = array_merge_recursive_distinct($config, $configEnv);
//}


date_default_timezone_set($config['php']['timezone']);
error_reporting($config['php']['error_reporting']);

if (!empty($config['php']['ini'])) {
    foreach ($config['php']['ini'] as $k => $v) {
        ini_set($k, $v);
    }
}