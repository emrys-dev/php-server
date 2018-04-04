<?php

use Phalcon\Mvc\Application;

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    /**
     * Include services
     */
    require __DIR__ . '/../app/configs/services.php';

    /**
     * Handle the request
     */
    $application = new Application();

    /**
     * Assign the DI
     */
    $application->setDI($di);

    /**
     * Include modules
     */
    require __DIR__ . '/../app/configs/modules.php';

    /**
     * Include dispatcher
     */
    require __DIR__ . '/../app/configs/dispatcher.php';

    /**
     * Handle application
     */
    $response = $application->handle();

    /**
     * Handle response
     */
    require __DIR__ . '/../app/configs/response.php';
    
    /**
     * Get the content
     */
    echo $response->getContent();
}
catch (Phalcon\Exception $e) {
    echo $e->getMessage();
}
catch (PDOException $e) {
    echo $e->getMessage();
}