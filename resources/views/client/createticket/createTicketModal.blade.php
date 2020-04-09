<div class="modal fade" id="createTicketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>

            <form method="POST" action="{{ route('client.ticketcreate.store') }}">
                @csrf
                <div class="form-row margin_left_right_20">
                    <div class="form-group col-md-6">

                        <label for="department" class="col-form-label text-md-right">{{ __('Department') }}</label>
                        <select class="form-control @error('department') is-invalid @enderror" id="department" name="department" required>
                            <option value="">Select Department</option>
                            @foreach($group as $groups)
                                <option value="{{ $groups->id }}">{{ $groups->name }}</option>
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
                        <select class="form-control @error('priority') is-invalid @enderror" id="priority" name="priority">
                            <option value="">Select Department</option>
                                <option value="1">Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                        </select>

                        @error('priority')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-12">

                        <label for="details" class="col-form-label text-md-right">{{ __('Details') }}</label>
                        <textarea class="form-control" id="details" rows="3" name="details"></textarea>

                        @error('details')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>