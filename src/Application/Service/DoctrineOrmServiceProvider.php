<?php

namespace Application\Provider;

use Pimple\Container;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider as BaseProvider;

/**
 * Doctrine ORM Service Provider
 *
 * Extends the Silex TwigServiceProvider with the ability to have multiple paths with namespaces
 */
class DoctrineOrmServiceProvider extends BaseProvider
{
    public function register(Container $app)
    {
        parent::register($app);
        $app['db.event_manager'] = $app->extend(
            'db.event_manager',
            function ($em, $app) {
                foreach ($app['db.options']['eventSubscribers'] as $eventSubscriber => $options) {
                    $em->addEventSubscriber(new $eventSubscriber($options));
                }

                return $em;
            }
        );
    }
}
