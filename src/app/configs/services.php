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
$di['router'] = function() {
    $router = new Router(false);

    // Defaults
    $router->setDefaultNamespace("App\Modules\Frontend\Controllers");
    $router->setDefaultModule("frontend");
    $router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_GET_URL);
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

    // Add all default routes
    foreach ($modules as $moduleName => $module) {
        $prefix = $module['prefix'];
        $namespace = $module['namespace'];
        
        $namespaceName = 'App\Modules\\' . $namespace . '\Controllers';

        if (in_array($moduleName, array('frontend', 'dashboard', 'admin'))) {
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
        }

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

    // Not found routes
    $router->add("/nao-encontrado/:params(/)?", [
        'namespace'  => 'App\Modules\Frontend\Controllers',
        'module'     => 'frontend',
        'controller' => 'Error',
        'action'     => 'notFound',
        'params'     => 1
    ]);

    $router->add("/not-found/:params(/)?", [
        'namespace'  => 'App\Modules\Frontend\Controllers',
        'module'     => 'frontend',
        'controller' => 'Error',
        'action'     => 'notFound',
        'params'     => 1
    ]);

    $router->notFound(array(
        'namespace'  => 'App\Modules\Frontend\Controllers',
        'module'     => 'frontend',
        'controller' => 'Error',
        'action'     => 'notFound'
    ));

    // Server error routes
    $router->add("/ocorreu-um-problema/:params(/)?", [
        'namespace'  => 'App\Modules\Frontend\Controllers',
        'module'     => 'frontend',
        'controller' => 'Error',
        'action'     => 'serverError',
        'params'     => 1
    ]);

    $router->add("/a-problem-occurred/:params(/)?", [
        'namespace'  => 'App\Modules\Frontend\Controllers',
        'module'     => 'frontend',
        'controller' => 'Error',
        'action'     => 'serverError',
        'params'     => 1
    ]);

    $router->add("/ops/:params(/)?", [
        'namespace'  => 'App\Modules\Frontend\Controllers',
        'module'     => 'frontend',
        'controller' => 'Error',
        'action'     => 'serverError',
        'params'     => 1
    ]);

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