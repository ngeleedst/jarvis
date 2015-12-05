<?php

$config = [];

$config['env'] = APPLICATION_ENV;

$config['debug'] = true;

$config['php'] = [
    'timezone'        => 'UTC',
    'error_reporting' => 0,
    'ini'             => [
        'display_errors'            => false,
        'display_startup_errors'    => false,
        'upload_max_filesize'       => '32M',
        'post_max_size'             => '32M',
    ]
];

$config['path'] = [
    'root'       => PATH_ROOT,
    'app'        => PATH_ROOT . 'app/',
    'config'     => PATH_ROOT . 'app/config/',
    'src'        => PATH_ROOT . 'src/',
    'cache'      => PATH_ROOT . 'var/cache/',
    'log'        => PATH_ROOT . 'var/log/',
    'data'       => [
        'private' => PATH_ROOT . 'var/',
        'public'  => PATH_ROOT . 'htdocs/data/',
        'upload'  => PATH_ROOT . 'htdocs/data/upload/'
    ],
    'module'     => PATH_ROOT . 'src/Module/',
    'vendor'     => PATH_ROOT . 'vendor/',
    'web'        => PATH_ROOT . 'htdocs/',
    'var'        => PATH_ROOT . 'var/',
    'migrations' => PATH_ROOT . 'var/migrations/',
    'tests'      => PATH_ROOT . 'tests/',
    'features'   => PATH_ROOT . 'features/',
    's3' => [
        'images'    => 'images/',
        'temp'      => 'images/temp/'
    ]
];

$config['url'] = [
    'base'      => HTTP_BASE,
    'images'    => HTTP_BASE.'images/',
    'temp'      => HTTP_BASE.'images/temp/',
    'data'      => [
        'upload'    => HTTP_BASE . 'data/upload/'
    ]
];

$config['version'] = [
    'assets' => 'src' // [deploytool]
];

$config['cache.options'] = [
    'namespace' => 'mediamonks',
    'default'   => 'apc'
];

$config['db.options'] = [
    'driver'           => 'pdo_mysql',
    'host'             => 'gr1u9a7c8lqrjoi.cydgm36eaxsm.us-east-1.rds.amazonaws.com',
    'port'             => 3306,
    'user'             => 'googlestjusprod',
    'password'         => 'Un24DyarX2AWTcOm73nt',
    'dbname'           => 'googlestjudeus',
    'charset'          => 'utf8',
    'driverOptions'    => [
        1002 => "SET NAMES 'UTF8'"
    ],
    'eventSubscribers' => [
        'Gedmo\Timestampable\TimestampableListener'               => [],
        'Gedmo\Sluggable\SluggableListener'                       => [],
        'Gedmo\Sortable\SortableListener'                         => [],
        'MediaMonks\Doctrine\ORM\Encryptable\EncryptableListener' => [
            'key'                => 'SzL_2gS^68&aQZU+JV~Ue*QZn8bzuMA-lN&)DbzG',
            'publicKey'          => PATH_ROOT . 'var/keys/orm_public_key.pub',
            'privateKey'         => PATH_ROOT . 'var/keys/orm_private_key.pem',
            'privateKeyPassword' => 'Xbvq0dFjD0xcn^~usx*ttj3ccPkTMFI@ir1cBpX6'
        ]
    ]
];

$config['orm.options'] = [
    'orm.proxies_dir'     => $config['path']['cache'] . 'doctrine',
    'orm.strategy.naming' => new \Doctrine\ORM\Mapping\UnderscoreNamingStrategy,
    'orm.em.options'      => [
        'mappings' => [
            [
                'type'                         => 'annotation',
//                'namespace'                    => 'Model\Entity',
                'path'                         => PATH_ROOT . 'src/Model/Entity',
//                'use_simple_annotation_reader' => false
            ]
        ]
    ]
];

var_dump($config['orm.options']['orm.em.options']);


$config['auth.options'] = [
    'auth.frontend.options' => [
        'name' => 'GoogleZooStJudeID'
    ],
    'auth.backend.options'  => [
        'secret' => 'FDme3LOc9ii~6GJEd+a=E%MczScsCBvHFiWM%Z1!'
    ]
];

$config['routing.options'] = [
    'cache_dir' => $config['path']['cache'] . 'routing/'
];

$config['signedrequest.options'] = [
    'key' => 'Dy5`FGBusMJqk-rWqz2IQIA&(UQ-efZ2oVAN~map'
];

$config['state.options'] = [
    'key'     => 'u(EmFdj-pP@D8xxu3g8Kum$u5p8m*X*&4zkA^7eX',
    'storage' => 'db'
];

$config['monolog.options'] = [
    'monolog.name'    => 'default',
    'monolog.level'   => \Monolog\Logger::WARNING,
    'monolog.logfile' => $config['path']['log'] . date('Y-m-d') . '.log'
];

$config['swiftmailer.options'] = [
    'host'       => 'host',
    'port'       => '25',
    'username'   => 'username',
    'password'   => 'password',
    'encryption' => null,
    'auth_mode'  => null
];


return $config;