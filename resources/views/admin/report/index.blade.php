@extends('layouts.backEnd.app')

@section('title', 'Report Download')

@section('content')
@php
$keyword = ' ';
if (!empty($_GET['src_keyword'])) {
    $keyword = $_GET['src_keyword'];
}    
@endphp
    <form method="GET" action="{{ route('admin.report.search') }}">
        <div class="row">
            <div class="col-md-10 form-row">
                <div class="form-group col-md-3">
                    <label for="src_type" class="col-form-label text-md-right">{{ __('Search Type') }}</label>
                    <select class="form-control @error('src_type') is-invalid @enderror" id="src_type" name="src_type" required>
                        <option value="">Select Search Type</option>
                        <option value="status" @if($src_type == 'status') {{'selected'}} @endif>Status</option>
                        <option value="assing_to" @if($src_type == 'assing_to') {{'selected'}} @endif>User</option>
                        <option value="department" @if($src_type == 'department') {{'selected'}} @endif>Department</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="src_keyword" class="col-form-label text-md-right">{{ __('Search Keyword') }}</label>
                    <select class="form-control @error('src_keyword') is-invalid @enderror" id="src_keyword" name="src_keyword" required>
                        <option value="">Select Search Keyword</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="start_date" class="col-form-label text-md-right">{{ __('Start Date') }}</label>
                    <input type="date" id="start_date" name="start_date" value="{{ date('Y-m-d', strtotime(str_replace('-','/', $start_date))) }}" required class="form-control">
                </div>

                <div class="form-group col-md-3">
                    <label for="end_date" class="col-form-label text-md-right">{{ __('End Date') }}</label>
                    <input type="date" id="end_date" name="end_date" value="{{ date('Y-m-d', strtotime(str_replace('-','/', $end_date))) }}" required class="form-control">
                </div> 
            </div>
            
            <div class="col-md-2">
                <div class="form-group col-md-3">
                    <div class="btn-group" role="group" aria-label="Basic example" style="margin-left: -39px;">
                        <button type="submit" class="btn btn-primary" style="margin-top: 36px;"><i class="fa fa-search" aria-hidden="true">&nbsp;Search</i></button>&nbsp;&nbsp;
                        <a id="admin_report_download_link" href="{{ route('admin.report.export',[$src_type,$src_keyword,$start_date,$end_date]) }}" target="blank">
                            <button type="button" id="admin_report_download" class="btn btn-danger" style="margin-top: 36px;"><i class="fa fa-download" aria-hidden="true">&nbsp;Download</i></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-header">@yield('title')</div>

        <div class="card-body">
            @if($count == 0)
                <h3 class="text-center" style="color: red;">No Data Found</h3>
            @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Created From</th>
                    <th scope="col">Department</th>
                    <th scope="col">Assigned To</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Status</th>
                    <th scope="col">Create Date</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;    
                    @endphp
                    @foreach ($search as $searchs)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $searchs->user_from_ticket->name }}</td>
                        <td>{{ $searchs->user_group->name}}</td>
                        <td>{{ $searchs->user_name_from_ticket->name}}</td>
                        <td>@if($searchs->priority == 1) <h5><span class="badge badge-info">Low</span></h5> @elseif($searchs->priority == 2) <h5><span class="badge badge-warning">Medium</span></h5> @elseif($searchs->priority == 3) <h5><span class="badge badge-danger">High</span></h5> @endif</td>
                        <td>@if($searchs->status == 1) <h5><span class="badge badge-secondary">New</span></h5> @elseif($searchs->status == 2) <h5><span class="badge badge-warning">Pending</span></h5>@elseif($searchs->status == 3) <h5><span class="badge badge-info">Work In Progess</span></h5>@elseif($searchs->status == 4) <h5><span class="badge badge-success">Solve</span></h5>@elseif($searchs->status == 5) <h5><span class="badge badge-danger">Wrong Ticket</span></h5>@endif</td>
                        <td>{{ date('Y-m-d H:m', strtotime($searchs->created_at)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
  
            $("#src_type").change(function(e) {
                e.preventDefault();
                src_keyword();
            });
            src_keyword();
        });

        function src_keyword()
        {
            var src_type = $("#src_type").val();
            var src_keyword =  "{{ $keyword }}"  ;

                $.ajax({
                    url: '{{ URL::to('search-keyword') }}',
                    data: {'src_type' : src_type, 'src_keyword' : src_keyword},
                    type: 'GET',
                    success: function (response) {
                        $('#src_keyword').html(response);
                    }, 
                });
        }
    </script>
@endpush
