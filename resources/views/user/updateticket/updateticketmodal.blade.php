<div class="modal fade" id="editModal{{ $tickets->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@yield('title')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>

            <form method="POST" action="{{ route('user.updateticket.update', $tickets->id) }}">
                @csrf
                @method('PUT')

                <div class="form-row margin_left_right_20">

                    <div class="form-group col-md-6">
                        <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name" value="{{ $tickets->user_from_ticket->name }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email" class="col-form-label text-md-right">{{ __('Email') }}</label>
                        <input type="email" id="email" name="email" value="{{ $tickets->user_from_ticket->email }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">

                        <label for="department" class="col-form-label text-md-right">{{ __('Department') }}</label>
                        <select class="form-control @error('department') is-invalid @enderror" id="department" name="department" readonly>
                            <option value="">Select Department</option>
                            @foreach($group as $groups)
                                <option value="{{ $groups->id }}" @if($groups->id == $tickets->department){{ "selected" }} @endif>{{ $groups->name }}</option>
                            @endforeach
                        </select>

                        @error('department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">

                        <label for="priority" class="col-form-label text-md-right">{{ __('Priority') }}</label>
                        <select class="form-control @error('priority') is-invalid @enderror" id="priority" name="priority" readonly>
                            <option value="">Select Department</option>
                            <option value="1" @if($tickets->priority == "1"){{ "selected" }} @endif>Low</option>
                            <option value="2" @if($tickets->priority == "2"){{ "selected" }} @endif>Medium</option>
                            <option value="3" @if($tickets->priority == "3"){{ "selected" }} @endif>High</option>
                        </select>

                        @error('priority')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">

                        <label for="status" class="col-form-label text-md-right">{{ __('Status') }}</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="1">New</option>
                            <option value="2">Pending</option>
                            <option value="3">Work In Progess</option>
                            <option value="4">Solve</option>
                            <option value="5">Wrong Ticket</option>
                        </select>

                        @error('priority')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-12">

                        <label for="details" class="col-form-label text-md-right">{{ __('Details') }}</label>
                        <textarea class="form-control" id="details" rows="3" name="details">{{ $tickets->details }}</textarea>

                        @error('details')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">User</th>
                            <th scope="col">Status</th>
                            <th scope="col">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets->history_from_ticket as $tickets_history)
                            <tr>
                                <td>{{ date('Y-m-d H:m', strtotime($tickets_history->created_at)) }}</td>
                                <td>{{ $tickets_history->user_name_from_history->name }}</td>
                                <td>@if($tickets_history->status == 1) <h5><span class="badge badge-secondary">New</span></h5> @elseif($tickets_history->status == 2) <h5><span class="badge badge-warning">Pending</span></h5>@elseif($tickets_history->status == 3) <h5><span class="badge badge-info">Work In Progess</span></h5>@elseif($tickets_history->status == 4) <h5><span class="badge badge-success">Solve</span></h5>@elseif($tickets_history->status == 5) <h5><span class="badge badge-danger">Wrong Ticket</span></h5>@endif</td>
                                <td>{{ $tickets_history->details }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>