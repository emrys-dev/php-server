<?php
/**
 * Dispatcher and events are handled in this file
 */

use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;

$di->set('dispatcher', function () {
    // Create an event manager
	$eventsManager = new EventsManager();
	
	// Attach the events
    $eventsManager->attach("dispatch", function (Event $event, $dispatcher, $exception) {
		
		// beforeException
		if ($event->getType() == 'beforeException') {

			switch ($exception->getCode()) {
				case \Phalcon\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
				case \Phalcon\Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
				case \Phalcon\Dispatcher::EXCEPTION_INVALID_HANDLER:
				case \Phalcon\Dispatcher::EXCEPTION_INVALID_PARAMS:
					$dispatcher->forward(array(
						'namespace'  => 'App\Modules\Frontend\Controllers',
						'module'     => 'frontend',
						'controller' => 'Error',
						'action'     => 'notFound',
						'params'     => $exception
					));

					return false;
					break;
				default:
					$dispatcher->forward(array(
						'namespace'  => 'App\Modules\Frontend\Controllers',
						'module'     => 'frontend',
						'controller' => 'Error',
						'action'     => 'serverError',
						'params'     => $exception
					));

					return false;
					break;
			}
		}
    });
    
    $dispatcher = new MvcDispatcher();

    // Bind the eventsManager to the view component
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
}, true);