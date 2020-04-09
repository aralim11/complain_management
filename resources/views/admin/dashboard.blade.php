@extends('layouts.backEnd.app')

@section('content')
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            <div class="row w-100" style="margin-top: 20px;">
                <div class="col-md-12">
                    <div class="card border-info p-3 col-md-12">
                        <div id="map" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row w-100" style="margin-top: 30px;">
                <div class="col-md-3">
                    <div class="card border-info mx-sm-1 p-3">
                        <div class="card border-info shadow text-info p-3 my-card" ><span class="fa fa-calculator" aria-hidden="true"></span></div>
                        <div class="text-info text-center mt-3"><h4>Total Ticket</h4></div>
                        <div class="text-info text-center mt-2"><h1>{{ $total_ticket }}</h1></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-danger mx-sm-1 p-3">
                        <div class="card border-danger shadow text-danger p-3 my-card" ><span class="fa fa-eye-slash" aria-hidden="true"></span></div>
                        <div class="text-danger text-center mt-3"><h4>Open Ticket</h4></div>
                        <div class="text-danger text-center mt-2"><h1>{{ $total_open }}</h1></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-success mx-sm-1 p-3">
                        <div class="card border-success shadow text-success p-3 my-card"><span class="fa fa-eye" aria-hidden="true"></span></div>
                        <div class="text-success text-center mt-3"><h4>Solved Ticket</h4></div>
                        <div class="text-success text-center mt-2"><h1>{{ $total_solve }}</h1></div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row w-100" style="margin-top: 30px;">

                <div class="col-md-3">
                    <div class="card border-dark mx-sm-1 p-3">
                        <div class="card border-dark shadow text-dark p-3 my-card" ><span class="fa fa-user-circle-o" aria-hidden="true"></span></div>
                        <div class="text-dark text-center mt-3"><h4>Total Admin</h4></div>
                        <div class="text-dark text-center mt-2"><h1>{{ $total_admin }}</h1></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-primary mx-sm-1 p-3">
                        <div class="card border-primary shadow text-primary p-3 my-card" ><span class="fa fa-user" aria-hidden="true"></span></div>
                        <div class="text-primary text-center mt-3"><h4>Supervisor</h4></div>
                        <div class="text-primary text-center mt-2"><h1>{{ $total_supervisor }}</h1></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-secondary mx-sm-1 p-3">
                        <div class="card border-secondary shadow text-secondary p-3 my-card"><span class="fa fa-users" aria-hidden="true"></span></div>
                        <div class="text-secondary text-center mt-3"><h4>User</h4></div>
                        <div class="text-secondary text-center mt-2"><h1>{{ $total_user }}</h1></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-info mx-sm-1 p-3">
                        <div class="card border-info shadow text-info p-3 my-card"><span class="fa fa-user-plus" aria-hidden="true"></span></div>
                        <div class="text-info text-center mt-3"><h4>Client</h4></div>
                        <div class="text-info text-center mt-2"><h1>{{ $total_client }}</h1></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('js')
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCXPojezZz8O7WylNTvOVkykO7eSfjjfgM" async="" defer="defer" type="text/javascript"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        var locations = [
            @foreach ($map_location as $map_locations)
                [ "{{ $map_locations->user_from_location->name }}", "{{ $map_locations->latitude }}", "{{ $map_locations->longitude }}" ], 
            @endforeach
        ];

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: new google.maps.LatLng(23.6850, 90.3563),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {  
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i][0]);
              infowindow.open(map, marker);
            }
          })(marker, i));
        }
    });
  </script>
@endpush
    

