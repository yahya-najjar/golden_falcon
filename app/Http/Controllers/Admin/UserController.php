<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
//        return $users[0]->role == 1 ?   ;

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create-edit');
    }


    public function store(UserRequest $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);
        $user = new User($request->except('password'));
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect(action('Admin\UserController@index'))->with('success',
            'Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.create-edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->except('password'));
        if ($request->has('password')) {
            $this->validate($request, [
                'password' => 'confirmed',
            ]);

            $user->update([
                'password' => bcrypt($request->get('password'))
            ]);
        }

        return back()->with('success',
            'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (count(User::all()) <= 2) {
            return back()->with('warning', 'you can not delete this user!');
        }
        User::destroy($id);

        return redirect(action('Admin\UserController@index'))->with('success',
            'Deleted!');
    }
}
