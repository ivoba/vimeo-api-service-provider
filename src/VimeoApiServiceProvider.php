<?php
namespace Ivoba\Silex;

use Ivoba\Silex\Exception\AccessDeniedException;
use Ivoba\Silex\Exception\ShowTokenException;
use Silex\Application;
use Silex\ServiceProviderInterface;

class VimeoApiServiceProvider implements ServiceProviderInterface
{

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app
     */
    public function register(Application $app)
    {

        $app['vimeo.api.show_token'] = $app->share(function () use ($app) {
            if($app['vimeo.api']->getToken()){
                throw new ShowTokenException('Your Token: ' . $app['vimeo.api']->getToken());
            }

            $token = $app['vimeo.api']->clientCredentials();
            if (isset($token['body']['error'])) {
                throw new AccessDeniedException($token['body']['error_description']);
            }
            throw new ShowTokenException('Your Token: ' . $token['body']['access_token']);
        });

        $app['vimeo.api'] = $app->share(function () use ($app) {
            return new \Vimeo\Vimeo($app['vimeo.options']['client_key'], $app['vimeo.options']['client_secret'], $app['vimeo.options']['access_token']);
        });
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     *
     * @param Application $app
     */
    public function boot(Application $app)
    {

    }

}