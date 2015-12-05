<?php

define('ENV_DEVELOPMENT', 'development');
define('ENV_DEVMONKS', 'devmonks');
define('ENV_UAT', 'uat');
define('ENV_PRODUCTION', 'production');

if (!defined('APPLICATION_ENV')) {
    if (getenv('ENVIRONMENT') !== false) {
        define('APPLICATION_ENV', getenv('ENVIRONMENT'));
    } else {
        if (php_sapi_name() == 'cli') {
            if (strpos(__DIR__, 'C:') !== false) {
                $environment = ENV_DEVELOPMENT;
            } elseif (strpos(__DIR__, '/Users/') !== false) {
                $environment = ENV_DEVELOPMENT;
            } elseif (strpos(__DIR__, 'devmonks.nl') !== false) {
                $environment = ENV_DEVMONKS;
            } else {
                $environment = ENV_PRODUCTION;
            }
        } elseif (!empty($_SERVER['SERVER_NAME'])) {
            switch ($_SERVER['SERVER_NAME']) {
                case 'localhost':
                    $environment = ENV_DEVELOPMENT;
                    break;
                case 'devmonks.nl':
                case 'www.devmonks.nl':
                case 'devmonks.vellance.net':
                    $environment = ENV_DEVMONKS;
                    break;
                case 'google-zoo-ElbWww-KOPG84DK5WFE-1702134236.us-east-1.elb.amazonaws.com':
                case 'dueaik6b7tvcb.cloudfront.net':
                case 'www-uat.social.stjude.org':
                    $environment = ENV_UAT;
                    break;
                default:
                    $environment = ENV_PRODUCTION;
                    break;
            }
        } else {
            $environment = ENV_PRODUCTION;
        }
        define('APPLICATION_ENV', $environment);
    }
}

if (isset($_REQUEST['ENVIRONMENT'])) {
    exit("<pre>ENVIRONMENT: " . APPLICATION_ENV . "\nSERVER_NAME: " . $_SERVER['SERVER_NAME'] . "\n</pre>");
}

if (!defined('PATH_ROOT')) {
    define('PATH_ROOT', realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);
}

if (!defined('DEBUG')) {
    define('DEBUG', APPLICATION_ENV === ENV_PRODUCTION ? false : true);
}

if (!defined('HTTP_BASE')) {
    $scheme   = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80) ? 'https://' : 'http://';
    $httpBase = $scheme . @$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    if (substr($httpBase, -1, 1) != '/') {
        $httpBase .= '/';
    }

    $httpBase = str_replace('share/', '', $httpBase);
    $httpBase = str_replace('vGLFK31ptrPfhAR/', '', $httpBase);
    $httpBase = str_replace('api/', '', $httpBase);

    define('HTTP_BASE', $httpBase);
}