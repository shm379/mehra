<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use ApiResponse;
    public int $perPage = 12;
    public $user_id = null;

    public function __construct()
    {
        if(auth()->guard('sanctum')->check())
            $this->user_id = auth()->guard('sanctum')->id();
    }

    public function callAction($method, $parameters)
    {
        if($method=='index'){
            $this->perPage = 12;
            if(isset(request()->query()['per_page'])){
                $this->perPage = (int)request()->query()['per_page'];
                if((int)request()->query()['per_page']>20)
                    $this->perPage = 12;
            }
        }
        return parent::callAction($method, $parameters); // TODO: Change the autogenerated stub
    }

    public function uploadMedia($model,$collectionName='gallery')
    {
        if(request()->hasFile('media')){
            foreach (request()->file('media') as $media){
                $model
                    ->addMedia($media) //starting method
                    ->toMediaCollection($collectionName);
            }
        }
    }


}
