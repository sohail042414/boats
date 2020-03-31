@extends('admin.layouts.adminlte')    

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Cruise Ships</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Cruise Ships</li>
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
          <div class="card">
            <div class="card-header">
              <a href="/ships/create" class="btn btn-success">Add New</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="ships-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Actions</th>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Ship Type</th>
                  <th>Cruise Category</th>
                  <th>Capacity</th>                  
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                  <th>Actions</th>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Ship Type</th>
                  <th>Cruise Category</th>
                  <th>Capacity</th>                               
                </tr>
                </tfoot>
              </table>
            </div>
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
        $('#ships-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('ships-grid') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'ship_type.name', name: 'shipType.name' },
                { data: 'cruise_category.name', name: 'cruiseCategory.name' },
                { data: 'capacity', name: 'capacity' } 
            ],
            columnDefs : [
              /*{
                "targets" : 2,
                "data": "img",
                "render" : function (data) {
                    return '<img class="img-size-50" src="images/'+data+'"/>';
                  }
              },
              */
              {
                "targets" : 0,                
                "render" : function (data,type,row) {
                    //var col_html = '<button type="button" data-row="'+row.id+'" class="btn btn-info btn-sm mr-1" onclick="editAmenity(this)"  >Edit</button><br>';
                    //col_html += '<button style="margin-top:10px;" type="button" class="btn btn-danger btn-sm" onclick="deleteAmenity('+data+')"  >Delete</button>';                    
                    var col_html = ' <div class="btn-group">';                           
                    col_html += '<button type="button" class="btn btn-info">Action</button>';
                    col_html += '<button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">';
                    col_html += '<span class="sr-only">Toggle Dropdown</span>';
                    col_html += '<div class="dropdown-menu" role="menu">';
                    col_html += '<a class="dropdown-item bg-gradient-primary" onclick="editTableRow('+row.id+')" href="/ships/edit/'+row.id+'">Edit</a>';
                    col_html += '<a class="dropdown-item bg-gradient-danger" onclick="deleteTableRow('+row.id+')" href="#">Delete</a>';
                    col_html += '</button>';
                    col_html += '</div>';                                
                    return col_html;

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
            url: "{{ url('/ships') }}/"+row_id,
            type: 'DELETE',
            success: function(response) {

              $(document).Toasts('create', {
                  title: 'Deletion Complete',
                  body: response.success,
                  class : 'bg-danger',
                  autohide:true,
                  delay : 3000,          
              });

              $('#ships-table').DataTable().rows().invalidate('data').draw(false);
            }
        });
    }

    function editTableRow(row_id){
      window.location.href = '/ships/'+row_id+'/edit';
    }
    </script>
    @endsection