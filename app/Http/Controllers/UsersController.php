<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->password != $request->confirmPassword) {
            return redirect('/users/create')->with('error', 'Password must be the same!');
        } else {
            $encrypted_pass = md5($request->password);
        }

        $user = new User;
        $user->admin_id = $request->adminID;
        $user->username = $request->username;
        $user->password = $encrypted_pass;
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->login_status = 0;
        $user->save();

        return redirect('/users')->with('success', 'Account Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->password != $request->confirmPassword) {
            return view('user.edit')->with('user', $user)->with('error', 'Password must be the same!');
        } else {
            
            if (!($request->password == null && $request->confirmPassword == null)) {
                $encrypted_pass = md5($request->password);
                $user->password = $encrypted_pass;
            }
        }

        $user->username = $request->username;
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->save();

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
