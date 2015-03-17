<?php

namespace Ivoba\Silex\Test;

use Ivoba\Silex\VimeoApiServiceProvider;
use Silex\Application;

class VimeoApiServiceProviderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException Ivoba\Silex\Exception\AccessDeniedException
     */
    public function testAccessDenied()
    {
        $app = new Application();

        $app->register(new VimeoApiServiceProvider(), array('vimeo.options' => array(
            'client_key' => 'key', 'client_secret' => 'secret', 'access_token' => ''
        )));
        $app->boot();

        $app['vimeo.api.show_token'];
    }


    public function testLink()
    {
        $app = new Application();

        $app->register(new VimeoApiServiceProvider(), array('vimeo.options' => array(
            'client_key' => 'key', 'client_secret' => 'secret', 'access_token' => 'my_token'
        )));
        $app->boot();

        $url = $app['vimeo.api']->buildAuthorizationEndpoint('http://localhost:8888', array('public'), 'therandomstate');
        $this->assertEquals('https://api.vimeo.com/oauth/authorize?response_type=code&client_id=key&redirect_uri=http%3A%2F%2Flocalhost%3A8888&scope=public&state=therandomstate', $url);
    }

    public function testVimeoApiIsVimeoApi()
    {
        $app = new Application();

        $app->register(new VimeoApiServiceProvider(), array('vimeo.options' => array(
            'client_key' => 'key', 'client_secret' => 'secret', 'access_token' => 'my_token'
        )));
        $app->boot();

        $this->assertInstanceOf('Vimeo\Vimeo', $app['vimeo.api']);
    }

}
