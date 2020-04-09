@extends('layouts.backEnd.app')

@section('title', 'User')

@section('content')
    <div class="card">
        <div class="card-header">@yield('title')<button class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">Add User</button>
            @if(session()->has('success_msg'))<span class="badge badge-success float-right" style="margin-top: 1px; margin-right: 8px; padding: 8px; font-size: 11px;">{{ Session('success_msg') }}</span> @endif
            @if(session()->has('delete_msg'))<span class="badge badge-danger float-right" style="margin-top: 1px; margin-right: 8px; padding: 8px; font-size: 11px;">{{ Session('delete_msg') }}</span> @endif</div>

        @include('admin.user.createModal')

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">Email</th>
                    <th scope="col">User Role</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @php $i = 1; @endphp
                @foreach($user as $users)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $users->name }}</td>
                    <td>{{ $users->user_group_for_admin->name }}</td>
                    <td>{{ $users->email }}</td>
                    <td>{{ $users->role->role }}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $users->id }}">Edit</button>&nbsp;&nbsp;
                            @include('admin.user.editModal')
                            <form method="POST" action="{{ route('admin.user.destroy', $users->id) }}">
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
            {{ $user->links() }}
        </div>
    </div>

@endsection

