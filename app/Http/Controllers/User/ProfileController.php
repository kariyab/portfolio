<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Profile_history;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function add()
    {
        return view('user.myprofile');
    }

    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = User::where('name', 'LIKE', "%{$cond_title}%")->get();
            
        } else {
            $posts = User::all();
        }
        return view('user.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function edit(Request $request)
    {
        $this->authorize('edit', $user);
        $user = User::find($request->id);
        if (empty($user)) {
        abort(404);
        }
        return view('user.myprofile',['user' => $user]);
    }
    
    public function update($user_id, Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request, User::$rules);
        $user = User::find($request->id);
        $user_form = $request->all();
        unset($user_form['_token']);
        
        $user->fill($user_form)->save();
        
        $profile_history = new Profile_history;
        $profile_history->profile_id = $profile->id;
        $profile_history->edited_at = Carbon::now();
        $profile_history->save();
        
        return redirect('user/myprofile');
    }
    public function delete(Request $request)
    {
        $this->authorize('delete', $user);
      $user = User::find($request->id);
      $user->delete();
      return redirect('/');
    }
}
