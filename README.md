# A Vimeo Api Service Provider for Silex

[![Latest Version](https://img.shields.io/github/release/ivoba/vimeo-api-service-provider.svg?style=flat-square)](https://github.com/ivoba/vimeo-api-service-provider/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/ivoba/vimeo-api-service-provider/master.svg?style=flat-square)](https://travis-ci.org/ivoba/vimeo-api-service-provider)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/ivoba/vimeo-api-service-provider.svg?style=flat-square)](https://scrutinizer-ci.com/g/ivoba/vimeo-api-service-provider/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/ivoba/vimeo-api-service-provider.svg?style=flat-square)](https://scrutinizer-ci.com/g/ivoba/vimeo-api-service-provider)
[![Total Downloads](https://img.shields.io/packagist/dt/ivoba/vimeo-api-service-provider.svg?style=flat-square)](https://packagist.org/packages/ivoba/vimeo-api-service-provider)

Service Provider that integrates Vimeo's official [PHP API libary](https://github.com/vimeo/vimeo.php) to [Silex](http://silex.sensiolabs.org)

## Install

Via Composer

``` bash
$ composer require ivoba/vimeo-api-service-provider
```

## Usage

Default modus is [unauthenticated](https://github.com/vimeo/vimeo.php#unauthenticated).  
It is recommended that you generated the access token once, store it to your config and use it forever.  
If you dont provide a token, your token will be retrieved from Vimeo for every call, which will cost performance.  

To show your token, call this once in your app, in debug mode. It will throw an exception that will show your token.

``` php
$app['vimeo.api.show_token'];
```

Register the Provider:
``` php
$app->register(new Ivoba\Silex\VimeoApiServiceProvider(), 
               array('vimeo.options' => array('client_key' => 'key', 'client_secret' => 'secret', 'access_token' => 'your_token')));
```

Now you can use the Vimeo API with:

``` php
$app['vimeo.api']->request('/me/videos', array('per_page' => 2), 'GET');
```

## Todo
I did not use authenticated mode yet, so this Provider doesnt have any helpers for it.  
Feel free to provide some.  

- authenticated mode
- token storage interface
- set & get token from storage if set

## Testing

``` bash
$ vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
