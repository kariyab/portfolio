<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bbs;
use App\History;
use Carbon\Carbon;

class BbsController extends Controller
{
    public function add()
    {
        return view('bbs.create');
    }
    
    public function create(Request $request)
    {
    $this->validate($request, Bbs::$rules);
    
    $bbs = new Bbs;
    $form = $request->all();

    unset($form['_token']);
    
    $bbs->fill($form);
    $bbs->save();
    
    return redirect('/');
    }
    
    public function index(Request $request)
    {
    $cond_title = $request->cond_title;
    if ($cond_title != '') {
        $posts = Bbs::where('title', 'LIKE', "%{$cond_title}%")->get();
    } else {
        $posts = Bbs::all();
    }
    return view('/', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function edit(Request $request)
    {
        $this->authorize('edit', $post);
        $bbs = Bbs::find($request->id);
        if (empty($bbs)) {
            abort(404);
        
    }
    return view('/', ['bbs_form' => $bbs]);
    }
    
    public function update(Request $request)
    {
        $this->authorize('update', $post);
        $this->validate($request, Bbs::$rules);
        $bbs = Bbs::find($request->id);
        
        $bbs_form = $request->all();
        
        unset($bbs_form['_token']);
        
        $bbs->fill($bbs_form)->save();
        
        $history = new History;
        $history->bbs_id = $bbs->id;
        $history->edited_at = Carbon::now();
        $history->save();
        
        return redirect('/');
    }
    
    public function delete(Request $request)
    {
        $this->authorize('delete', $post);
        $bbs = Bbs::find($request->id);
        $bbs->delete();
        return redirect('/');
    }
}