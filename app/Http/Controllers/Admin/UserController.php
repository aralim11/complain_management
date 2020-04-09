<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\User_group;
use App\User_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with(['role' , 'user_group_for_admin'])->paginate(8);
        $group = User_group::all();
        $role = User_role::all();

        return view('admin.user.index', compact(['user', 'group', 'role']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'user_group_id' => ['required'],
            'user_role' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);

        if ($validator->fails())
        {
            session()->flash('delete_msg', 'Error!! Check Hints!!');
            return redirect()->back()->withErrors($validator)->withInput();

        } else {

            User::create([
               'name' => $request->name,
               'user_group_id' => $request->user_group_id,
               'user_role' => $request->user_role,
               'email' => $request->email,
               'phone' => $request->phone,
               'password' => Hash::make($request->password),
            ]);

            session()->flash('success_msg', 'User Inserted!!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'user_group_id' => ['required'],
            'user_role' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($validator->fails())
        {
            session()->flash('delete_msg', 'Update Failed!! Check Hints!!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $user = User::find($id);
            $user->name = $request->name;
            $user->user_group_id = $request->user_group_id;
            $user->user_role = $request->user_role;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->update();

            session()->flash('success_msg', 'User Updated!!');
            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!empty($id))
        {
            $user = User::find($id);
            $user->delete();

            session()->flash('delete_msg', 'User Delete!!');
            return redirect()->back();
        }
    }
}
