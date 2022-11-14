<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Producer;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    public function publisher($q, Request $request)
    {
        $result = Producer::where('title', 'LIKE', '%' . $q . '%')->get();
        return $result;
    }
}
