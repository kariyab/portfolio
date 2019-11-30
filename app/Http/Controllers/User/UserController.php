<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        
        return view('user.index',[ 'auth' => $auth ]);
        
    }

}
