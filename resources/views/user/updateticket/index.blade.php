@extends('layouts.backEnd.app')

@section('title', 'Update Ticket')

@section('content')

    <div class="card">
        <div class="card-header">@yield('title')
            @if(session()->has('success_msg'))<span class="badge badge-success float-right" style="margin-top: 1px; margin-right: 8px; padding: 8px; font-size: 11px;">{{ Session('success_msg') }}</span> @endif
            @if(session()->has('delete_msg'))<span class="badge badge-danger float-right" style="margin-top: 1px; margin-right: 8px; padding: 8px; font-size: 11px;">{{ Session('delete_msg') }}</span> @endif</div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Created From</th>
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
                        <td>{{ $tickets->user_from_ticket->name }}</td>
                        <td>{{ $tickets->user_group->name }}</td>
                        <td>@if($tickets->priority == 1) <h5><span class="badge badge-info">Low</span></h5> @elseif($tickets->priority == 2) <h5><span class="badge badge-warning">Medium</span></h5> @elseif($tickets->priority == 3) <h5><span class="badge badge-danger">High</span></h5> @endif</td>
                        <td>@if($tickets->status == 1) <h5><span class="badge badge-secondary">New</span></h5> @elseif($tickets->status == 2) <h5><span class="badge badge-warning">Pending</span></h5>@elseif($tickets->status == 3) <h5><span class="badge badge-info">Work In Progess</span></h5>@elseif($tickets->status == 4) <h5><span class="badge badge-success">Solve</span></h5>@elseif($tickets->status == 5) <h5><span class="badge badge-danger">Wrong Ticket</span></h5>@endif</td>
                        <td>{{ date('Y-m-d H:m', strtotime($tickets->created_at)) }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $tickets->id }}" onclick="editModalForUser(this);">Update Ticket</button>
                                @include('user.updateticket.updateticketmodal')
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

{{--<script type="application/javascript">--}}

{{--    function editModalForUser(el) {--}}

{{--        var ticket_id = '3';--}}
{{--        $.ajax({--}}
{{--            url: "{{route('user.updateticket.edit')}}",--}}
{{--            data: {id: ticket_id},--}}
{{--            dataType: "text",--}}
{{--            headers: {--}}
{{--                'X-CSRF-Token': '{{ csrf_token() }}',--}}
{{--            },--}}
{{--            success: function (sussess) {--}}
{{--                alert(sussess);--}}
{{--                $('#editModal').modal('show');--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}

{{--</script>--}}
