@extends('admin.layouts.adminlte')    

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Users</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
            <div class="card-header">
                <a href="{{ url('/users/create') }}" class="btn btn-success">Add New</a>            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="users-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Actions</th>     
                  <th>Id</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Type</th>                
                  <th>Email</th>
                  <th>Created</th>
                  <th>Updated</th>
                 </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                  <th>Actions</th>     
                  <th>Id</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Type</th>  
                  <th>Email</th>
                  <th>Created</th>
                  <th>Updated</th>  
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
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('users-grid') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'id', name: 'id' },
                { data: 'image', name: 'image' },
                { data: 'name', name: 'name' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
            ],
            columnDefs : [
              {
                "targets" : 2,
                "data": "img",
                "render" : function (data) {
                    return '<img class="img-size-50" src="uploads/'+data+'"/>';
                  }
              },
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
                    col_html += '<a class="dropdown-item bg-gradient-primary" data-row="'+row.id+'" onclick="editTableRow(this)" href="#">Edit</a>';
                    col_html += '<a class="dropdown-item bg-gradient-info" data-row="'+row.id+'"  onclick="changeUserPass(this)" href="#">Change Password</a>';
                    col_html += '<a class="dropdown-item bg-gradient-danger" data-row="'+row.id+'"  onclick="deleteTableRow(this)" href="#">Delete</a>';
                    col_html += '</button>';
                    col_html += '</div>';                                
                    return col_html;

                  }
              }
            ]
        });
    });


    function deleteTableRow(obj){

        var confirmed = confirm('Are you sure? ');

        if(confirmed == false){
          return false;
        }

        var row_id = $(obj).attr('data-row');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('/users') }}/"+row_id,
            type: 'DELETE',
            success: function(response) {

              $(document).Toasts('create', {
                  title: 'Deletion Complete',
                  body: response.success,
                  class : 'bg-danger',
                  autohide:true,
                  delay : 3000,          
              });

              $('#users-table').DataTable().rows().invalidate('data').draw(false);
            }
        });
      }

      function editTableRow(obj){          
          var row_id = $(obj).attr('data-row'); 
          window.location.href = '/users/'+row_id+'/edit';
      }

      function changeUserPass(obj){          
          var row_id = $(obj).attr('data-row'); 
          window.location.href = '/users/'+row_id+'/change-password';
      }

    </script>
    @endsection