<?php
namespace App\Traits;

use App\Helpers\Helpers;
use App\Models\UserView;
use App\Notifications\SendVerifySMS;

trait LogsUserView {
    public function views(){
        return $this->morphMany(UserView::class,'model');
    }
}