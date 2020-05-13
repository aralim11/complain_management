<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\User_role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        if ($id != Auth::user()->id) {
            return redirect()->back();
        }
        
        $profile = User::with('role')->find($id);

        return view('client.profile.index', compact('profile'));
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
            'phone' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'password' => ['nullable', 'string', 'min:4', 'confirmed'],
        ]);



        if($validator->fails())
        {
            session()->flash('delete_msg', 'User Not Updated!!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $profile = User::find($id);
            $profile->name = $request->name;
            $profile->email = $request->email;
            $profile->phone = $request->phone;
            if (!empty($request->password)) {
                if (!Hash::check($request['old_password'], Auth::user()->password)) {
                    session()->flash('pass_msg', 'The old password does not match!!');
                    return redirect()->back();
                } else {
                    $profile->password = Hash::make($request->password);
                }
            }
            
            $profile->update();

            session()->flash('success_msg', 'Profile Updated!!');
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
        //
    }
}
