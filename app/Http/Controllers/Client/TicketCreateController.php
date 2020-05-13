<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Ticket;
use App\User;
use App\User_group;
use App\TicketHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\ClientTicket;
use Illuminate\Support\Facades\Notification;

class TicketCreateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = User_group::all();
        $ticket = Ticket::where('created_from', Auth::id())->with('user_group')->paginate(8);
        $notifications = tap(Auth::user()->unreadNotifications)->markAsRead();
        // $notifications->markAsRead();

        foreach($notifications as $notification)
        {  
            echo "Your Ticket id : ".$notification->data['ticket_id']."<br>";
        }

        return view('client.createticket.index', compact(['group', 'ticket']));
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
            'department' => ['required'],
            'details' => ['required'],
        ]);


      if (!empty(Auth::id()))
      {
          if ($validator->fails())
          {
              session()->flash('delete_msg', 'Error!! Check Hints!!');
              return redirect()->back()->withErrors($validator)->withInput();

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

              Ticket::create([
                 'created_from' => Auth::id(),
                 'assing_to' => $assign_to,
                 'department' => $request->department,
                 'status' => $request->status,
                 'priority' => $request->priority,
                 'details' => $request->details,
              ]);

              $ticket_data = Ticket::where('created_from', Auth::id())->with('user_from_ticket')->orderBy('id', 'DESC')->first();
              $user = User::where('id', Auth::user()->id)->get();
            
              Notification::send($user, new ClientTicket($ticket_data));

              session()->flash('success_msg', 'Ticket Created!!');
              return redirect()->back();
          }
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
            'name' => ['required'],
            'email' => ['required'],
            'department' => ['required'],
            'priority' => ['required'],
            'details' => ['required'],
        ]);

        if($validator->fails())
        {
            session()->flash('delete_msg', 'Error!! Check Hints!!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $ticket = Ticket::find($id);

            TicketHistory::create([
                'ticket_id' => $id,
                'user_id' => Auth::id(),
                'status' => $ticket->status,
                'details' => $request->details,
             ]);

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
