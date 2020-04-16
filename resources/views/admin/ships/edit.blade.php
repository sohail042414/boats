@extends('admin.layouts.adminlte')    

@section('styles')
<link rel="stylesheet" href="{{ asset('vendor/adminlte') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('vendor/adminlte') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('vendor/adminlte') }}/plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Ship</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/ships">Cruise Ships</a></li>
                    <li class="breadcrumb-item active">Update</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                There are some errors, check each field carefully! {{--
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                --}}
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
                <div class="card-header d-flex p-0">
                    <ul class="nav nav-pills p-2" style="">
                        <li class="nav-item"><a class="nav-link {{ ($tab == 'general' ? 'active' : '') }}" href="#tab_1" data-toggle="tab">General</a></li>
                        <li class="nav-item"><a class="nav-link {{ ($tab == 'images' ? 'active' : '') }}" href="#tab_2" data-toggle="tab">Images</a></li>
                        <li class="nav-item"><a class="nav-link {{ ($tab == 'itineraries' ? 'active' : '') }}" href="#tab_3" data-toggle="tab">Itineraries</a></li>
                        <li class="nav-item dropdown" style="display: none;">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                              Dropdown <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" style="display:none;">
                                <a class="dropdown-item" tabindex="-1" href="#">Action</a>
                                <a class="dropdown-item" tabindex="-1" href="#">Another action</a>
                                <a class="dropdown-item" tabindex="-1" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" tabindex="-1" href="#">Separated link</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane {{ ($tab == 'general' ? 'active' : '') }}" id="tab_1">
                            @include('admin/ships/edit_general')
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane {{ ($tab == 'images' ? 'active' : '') }}" id="tab_2">
                            @include('admin/ships/edit_images')
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane {{ ($tab == 'itineraries' ? 'active' : '') }}" id="tab_3">
                            @include('admin/ships/edit_itineraries')
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- ./card -->
    </div>
    <!-- /.col -->
</section>
<!-- /.content -->

@endsection
@section('scripts')
    <script src="{{ asset('vendor/adminlte') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('vendor/adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
    
    $('.select2').select2();
    $('#start_date').datepicker();
    $('#end_date').datepicker();
    //Images scripts
    $(function() {
        $('#ship-images-table').DataTable({
            processing: true,            
            serverSide: true,
            ajax: '{!! route("ship-images-grid",["ship_id"=>$ship->id]) !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'id', name: 'id' },
            ],
            columnDefs : [              
              {
                "targets" : 1,
                "data": "img",
                "render" : function (data) {
                    return '<img class="img-size-50" title="'+data+'" src="{!! asset('uploads') !!}/'+data+'"/>';
                  }
              },    
              {
                "targets" : 2,                
                "render" : function (data,type,row) {
                    return  '<button style="margin-top:10px;" type="button" class="btn btn-danger btn-sm" onclick="deleteTableRow('+data+')"  >Delete</button>';                    
                  }
              }
            ]
        });
    });

    function deleteTableRow(row_id){

        var confirmed = confirm('Are you sure? ');
        if(confirmed == false){
          return false;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('/ship-images') }}/"+row_id,
            type: 'DELETE',
            success: function(response) {

              $(document).Toasts('create', {
                  title: 'Deletion Complete',
                  body: response.success,
                  class : 'bg-danger',
                  autohide:true,
                  delay : 3000,          
              });

              $('#ship-images-table').DataTable().rows().invalidate('data').draw(false);
            }
        });
    }

    //Itineraries scripts
    $(function() {
        $('#ship-itineraries-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route("itineraries-grid",["ship_id"=>$ship->id]) !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'id', name: 'id' },
                { data: 'code', name: 'code' },
                { data: 'title', name: 'title' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' }
            ],           
            columnDefs : [
              {
                "targets" : 0,
                "render" : function (data,type,row) {                  
                    var col_html = ' <div class="btn-group">';                           
                    col_html += '<button type="button" class="btn btn-info">Action</button>';
                    col_html += '<button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">';
                    col_html += '<span class="sr-only">Toggle Dropdown</span>';
                    col_html += '<div class="dropdown-menu" role="menu">';
                    col_html += '<a class="dropdown-item bg-gradient-danger" data-row="'+row.id+'"  onclick="deleteItineraryRow(this)">Delete</a>';
                    col_html += '</button>';
                    col_html += '</div>';                                
                    return col_html;
                  }
              }
            ]
        });
    });

    function deleteItineraryRow(obj){
      
      var confirmed = confirm('Are you sure? ');

      if(confirmed == false){
        return false;
      }

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var row_id = $(obj).attr('data-row');

      $.ajax({
          url: "{{ url('/itineraries') }}/"+row_id,
          type: 'DELETE',
          success: function(response) {

            $(document).Toasts('create', {
                title: 'Deletion Complete',
                body: response.success,
                class : 'bg-danger',
                autohide:true,
                delay : 3000,          
            });

            $('#ship-itineraries-table').DataTable().rows().invalidate('data').draw(false);
          }
      });
    }
</script>
@endsection