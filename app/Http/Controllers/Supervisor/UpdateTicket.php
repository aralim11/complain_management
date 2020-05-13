<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Ticket;
use App\TicketHistory;
use App\User_group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UpdateTicket extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = User_group::all();
        $ticket = Ticket::where('department', Auth::user()->user_group_id)->with(['user_group', 'user_from_ticket', 'user_name_from_ticket', 'history_from_ticket'])->paginate(8);

        return view('supervisor.updateticket.index', compact(['ticket', 'group']));
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
            'name' => ['required'],
            'email' => ['required'],
            'department' => ['required'],
            'priority' => ['required'],
            'status' => ['required'],
        ]);

        if ($validator->fails())
        {
            session()->flash('delete_msg', 'Error!! Check Hints!!');
            return redirect()->back()->withInput()->withErrors($validator);
        } else {

            $array = array();
            $assign_to = null;
            $user = User::select('id')->where('user_role', 3)->where('user_group_id', $request->department)->get();
            foreach ($user as $users)
            {
                $assign = Ticket::where('assing_to', $users->id)->count();
                $array[$users->id] = $assign;
            }

            if (!empty($array))
            {
                $free_user = array_keys($array, min($array));
                $assign_to = $free_user[0];
            }

            TicketHistory::create([
                'ticket_id' => $id,
                'user_id' => Auth::id(),
                'status' => $request->status,
                'details' => $request->details,
            ]);

            $ticket = Ticket::find($id);
            $ticket->department = $request->department;
            $ticket->status = $request->status;
            $ticket->assing_to = $assign_to;

            $ticket->update();

            session()->flash('success_msg', 'Ticket Updated!!');
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
