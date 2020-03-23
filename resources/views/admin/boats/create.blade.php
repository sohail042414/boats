@extends('admin.layouts.adminlte')    

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Boats/Ships/Cruises</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item ">Boats</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create New Boat</h3>
            </div>
            <!-- /.card-header -->
            <p></p>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    @endsection
    @section('scripts')
    <script src="{{ asset('vendor/adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
    $(function() {
        $('#boats-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('boats-grid') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'image', name: 'image' },
                { data: 'name', name: 'name' },
                { data: 'short_description', name: 'id' },
                { data: 'capacity', name: 'capacity' },
                { data: 'type.name', name: 'type.name' },
                { data: 'class.name', name: 'class.name' },
                { data: 'year_built', name: 'year_built' }
            ],
            columnDefs : [
              {
                "targets" : 1,
                "data": "img",
                "render" : function (data) {
                    return '<img class="img-size-50" src="images/'+data+'"/>';
                  }
              }
            ]
        });
    });
    </script>
    @endsection