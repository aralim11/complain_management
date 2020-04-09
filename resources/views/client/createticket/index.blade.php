@extends('layouts.backEnd.app')

@section('title', 'Create Ticket')

@section('content')

<div class="card">
    <div class="card-header">@yield('title')<button class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#createTicketModal">Create Ticket</button>
    @if(session()->has('success_msg'))<span class="badge badge-success float-right" style="margin-top: 1px; margin-right: 8px; padding: 8px; font-size: 11px;">{{ Session('success_msg') }}</span> @endif
    @if(session()->has('delete_msg'))<span class="badge badge-danger float-right" style="margin-top: 1px; margin-right: 8px; padding: 8px; font-size: 11px;">{{ Session('delete_msg') }}</span> @endif</div>
    @include('client.createticket.createTicketModal')

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Department</th>
                <th scope="col">Priority</th>
                <th scope="col">Status</th>
                <th scope="col">Create Date</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @php $i = 1; @endphp
            @foreach($ticket as $tickets)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $tickets->user_group->name }}</td>
                    <td>@if($tickets->priority == 1) <h5><span class="badge badge-info">Low</span></h5> @elseif($tickets->priority == 2) <h5><span class="badge badge-warning">Medium</span></h5> @elseif($tickets->priority == 3) <h5><span class="badge badge-danger">High</span></h5> @endif</td>
                    <td>@if($tickets->status == 1) <h5><span class="badge badge-info">New</span></h5> @elseif($tickets->status == 2) <h5><span class="badge badge-info">Pending</span></h5>@elseif($tickets->status == 3) <h5><span class="badge badge-info">Work In Progess</span></h5>@elseif($tickets->status == 4) <h5><span class="badge badge-info">Solve</span></h5>@elseif($tickets->status == 5) <h5><span class="badge badge-info">Wrong Ticket</span></h5>@endif</td>
                    <td>{{ date('Y-m-d H:m', strtotime($tickets->created_at)) }}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $tickets->id }}">Edit</button>&nbsp;&nbsp;

                            <form method="POST" action="{{ route('admin.user.destroy', $tickets->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $ticket->links() }}
    </div>
</div>

@endsection
