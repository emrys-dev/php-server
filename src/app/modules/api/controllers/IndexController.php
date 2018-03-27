<?php
namespace App\Modules\Api\Controllers;

use Modules\Models\Services\Services;

class IndexController extends ControllerBase
{
    public function getAction()
    {
        try {
            die(var_dump('api get!!!'));
        }
        catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function postAction()
    {
        try {
            die(var_dump('api post!!!'));
        }
        catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function putAction()
    {
        try {
            die(var_dump('api put!!!'));
        }
        catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function deleteAction()
    {
        try {
            die(var_dump('api delete!!!'));
        }
        catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }
}