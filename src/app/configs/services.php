<?php
/**
 * Services are globally registered in this file
 */

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\DI\FactoryDefault;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Registering a router
 */
$di['router'] = function () {
    $router = new Router();

    // Defaults
    $router->setDefaultNamespace("App\Modules\Frontend\Controllers");
    $router->setDefaultModule("frontend");
    $router->setDefaultController("index");
    $router->setDefaultAction("index");
    $router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);
    $router->removeExtraSlashes(true);

    // Modules
    $modules = [
        'frontend' => array(
            'prefix' => '',
            'namespace' => 'Frontend'
        ),
        'dashboard' => array(
            'prefix' => '/dashboard',
            'namespace' => 'Dashboard'
        ),
        'admin' => array(
            'prefix' => '/admin',
            'namespace' => 'Admin'
        ),
        'api' => array(
            'prefix' => '/api',
            'namespace' => 'Api'
        )
    ];

    // Add all routes
    foreach ($modules as $moduleName => $module) {
        $prefix = $module['prefix'];
        $namespace = $module['namespace'];

        $namespaceName = 'App\Modules\\' . $namespace . '\Controllers';

        $router->add("{$prefix}(/)?", [
            'namespace'  => $namespaceName,
            'module'     => $moduleName,
            'controller' => 'index',
            'action'     => 'index',
        ]);

        $router->add("{$prefix}/:controller(/)?", [
            'namespace'  => $namespaceName,
            'module'     => $moduleName,
            'controller' => 1,
            'action'     => 'index',
        ]);

        $router->add("{$prefix}/:controller/:action(/)?", [
            'namespace'  => $namespaceName,
            'module'     => $moduleName,
            'controller' => 1,
            'action'     => 2,
        ]);

        $router->add("{$prefix}/:controller/:action/:params(/)?", [
            'namespace'  => $namespaceName,
            'module'     => $moduleName,
            'controller' => 1,
            'action'     => 2,
            'params'     => 3,
        ]);
    }

    return $router;
};

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di['url'] = function () {
    $url = new UrlResolver();
    $url->setBaseUri('/');

    return $url;
};

/**
 * Start the session the first time some component request the session service
 */
$di['session'] = function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
};