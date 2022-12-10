<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public int $perPage = 12;
    public function callAction($method, $parameters)
    {
        if($method=='index'){
            $this->perPage = 12;
            if($parameters[0]->query->has('per_page')){
                $this->perPage = (int)$parameters[0]->query->get('per_page');
                if($parameters[0]->query->get('per_page')>20)
                    $this->perPage = 12;
            }
        }
        return parent::callAction($method, $parameters); // TODO: Change the autogenerated stub
    }


}
