<?php

$app = require __DIR__ . '/../src/bootstrap.php';


var_dump($app['orm.em']->getRepository('Temperature'));
$app->get('/api/temp/current', function () use ($app){

    return 1;
    $sql = "SELECT * FROM temperatures";
    $post = $app['db']->fetchAssoc($sql);
    return 'Hello!';
});

$app->run();
