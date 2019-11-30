<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bbs;
use App\History;
use Carbon\Carbon;
use Illuminate\Support\Facades\HTML;

class BbsController extends Controller
{
    public function index(Request $request)
    {
        $posts = Bbs::all()->sortByDesc('updated_at');

        return view('bbs.index', ['posts' => $posts]);
    }
}