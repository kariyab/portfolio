<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $posts = User::all()->sortByDesc('updated_at');

        return view('user.index', ['posts' => $posts]);
    }
}