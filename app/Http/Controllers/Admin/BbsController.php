<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bbs;
use App\History;
use Carbon\Carbon;

class BbsController extends Controller
{
    public function add()
    {
        return view('admin.bbs.create');
    }
    
    public function create(Request $request)
    {
    $this->validate($request, Bbs::$rules);
    
    $bbs = new Bbs;
    $form = $request->all();

    unset($form['_token']);
    
    $bbs->fill($form);
    $bbs->save();
    
    return redirect('admin/bbs/create');
    }
    
    public function index(Request $request)
    {
    $cond_title = $request->cond_title;
    if ($cond_title != '') {
        $posts = Bbs::where('title', $cond_title)->get();
    } else {
        $posts = Bbs::all();
    }
    return view('admin.bbs.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function edit(Request $request)
    {
    $bbs = Bbs::find($request->id);
    if (empty($bbs)) {
        abort(404);
        
    }
    return view('admin.bbs.edit', ['bbs_form' => $bbs]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request, Bbs::$rules);
        $bbs = Bbs::find($request->id);
        
        $bbs_form = $request->all();
        
        unset($bbs_form['_token']);
        
        $bbs->fill($bbs_form)->save();
        
        $history = new History;
        $history->bbs_id = $bbs->id;
        $history->edited_at = Carbon::now();
        $history->save();
        
        return redirect('admin/bbs/');
    }
    
    public function delete(Request $request)
    {
        $bbs = Bbs::find($request->id);
        $bbs->delete();
        return redirect('admin/bbs/');
    }
}