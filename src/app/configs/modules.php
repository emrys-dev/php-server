<?php
/**
 * Register application modules
 */

$application->registerModules([
    'frontend'  => [
        'className' => 'App\Modules\Frontend\Module',
        'path'      => __DIR__ . '/../modules/frontend/Module.php'
    ],
    'dashboard' => [
        'className' => 'App\Modules\Dashboard\Module',
        'path'      => __DIR__ . '/../modules/dashboard/Module.php'
    ],
    'admin'  => [
        'className' => 'App\Modules\Admin\Module',
        'path'      => __DIR__ . '/../modules/admin/Module.php'
    ],
    'api'  => [
        'className' => 'App\Modules\Api\Module',
        'path'      => __DIR__ . '/../modules/api/Module.php'
    ]
]);