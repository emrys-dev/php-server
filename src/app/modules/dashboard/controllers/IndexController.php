<?php
namespace App\Modules\Dashboard\Controllers;

use Modules\Models\Services\Services;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        try {
            $this->view->users = Services::getService('User')->getLast();
        }
        catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }
}