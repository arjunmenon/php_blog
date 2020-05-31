<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        return view('user.show', ['user' => User::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->save();

        return redirect("/dashboard/")->with('success', "user was updated");
    }
}
