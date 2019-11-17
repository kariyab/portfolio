<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;
use App\Bbs;

class BbsController extends Controller
{
    public function index(Request $request)
    {
        $posts = Bbs::all()->sortByDesc('updated_at');

        return view('bbs.index', ['posts' => $posts]);
    }
}