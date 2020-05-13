@extends('layouts.backEnd.app')

@section('title', 'Department')

@section('content')
    <div class="card">
        <div class="card-header">@yield('title')<button class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">Add Department</button>
            @if(session()->has('success_msg'))<span class="badge badge-success float-right" style="margin-top: 1px; margin-right: 8px; padding: 8px; font-size: 11px;">{{ Session('success_msg') }}</span> @endif
            @if(session()->has('delete_msg'))<span class="badge badge-danger float-right" style="margin-top: 1px; margin-right: 8px; padding: 8px; font-size: 11px;">{{ Session('delete_msg') }}</span> @endif</div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Department Name</th>
                    <th scope="col">Total Ticket</th>
                    <th scope="col">Solved</th>
                    <th scope="col">Create Date</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @php $i = 1; @endphp
                @foreach($dept as $depts)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $depts->name }}</td>
                    <td>{{ $depts->group_count()->count() }}</td>
                    <td>{{ $depts->group_solve_count()->count() }}</td>
                    <td>{{ date('Y-m-d H:m', strtotime($depts->created_at)) }}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $depts->id }}">Edit</button>&nbsp;&nbsp;
                            @include('admin.group.editModal')
                            <form method="POST" action="{{ route('admin.group.destroy', $depts->id) }}">
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
            {{ $dept->links() }}
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" action="{{ route('admin.group.store') }}">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label text-md-right">{{ __('Department') }}</label>
                            <input id="name_save" type="text" class="form-control @error('name') is-invalid @enderror" name="name" >
                        
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong id="name_save_msg">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save_dept">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#save_dept").click(function(e) {
                e.preventDefault();
                var data = $("#name_save").val();

                if(data == '')
                {
                    $("#name_save").addClass("is-invalid");

                } else {
                    $("#name_save").removeClass("is-invalid"); 
                }

                $.ajax({
                    url: 'save-book',
                    data: {'id': data},
                    type: 'POST',
                    datatype: 'JSON',
                    success: function (response) {

                    },
                    error: function (response) {

                    }
                });
            });
        });
    </script>
@endpush