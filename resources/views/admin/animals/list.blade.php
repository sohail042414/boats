@extends('admin.layouts.adminlte')    

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Animals/Birds</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Animals/Birds</li>
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
          <div class="card card-primary">
            <div class="card-header">
              <a href="{{ url('/animals/create') }}" class="btn btn-success">Add New</a>            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="animals-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Actions</th>
                  <th>Id</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Type</th>  
                  <th>Short Description</th>                        
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
                  <th>Short Description</th>                        
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
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
        $('#animals-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('animals-grid') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'id', name: 'id' },
                { data: 'image', name: 'image' },
                { data: 'name', name: 'name' },
                { data: 'type', name: 'type' },
                { data: 'short_description', name: 'short_description' },
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
                "data": "img",
                "render" : function (data,type,row) {                  
                    var col_html = ' <div class="btn-group">';                           
                    col_html += '<button type="button" class="btn btn-info">Action</button>';
                    col_html += '<button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">';
                    col_html += '<span class="sr-only">Toggle Dropdown</span>';
                    col_html += '<div class="dropdown-menu" role="menu">';
                    col_html += '<a class="dropdown-item bg-gradient-primary" data-row="'+row.id+'" onclick="editTableRow(this)" href="#">Edit</a>';
                    col_html += '<a class="dropdown-item bg-gradient-danger" data-row="'+row.id+'"  onclick="deleteTableRow(this)">Delete</a>';
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

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var row_id = $(obj).attr('data-row');

      $.ajax({
          url: "{{ url('/animals') }}/"+row_id,
          type: 'DELETE',
          success: function(response) {

            if(response.success){
                $(document).Toasts('create', {
                    title: 'Operation Completed!',
                    body: response.success,
                    class : 'bg-success',
                    autohide:true,
                    delay : 3000,          
                });
            }else if(response.error){
              $(document).Toasts('create', {
                    title: 'Operation Failed!',
                    body: response.error,
                    class : 'bg-danger',
                    autohide:true,
                    delay : 5000,          
                });
            }

            $('#animals-table').DataTable().rows().invalidate('data').draw(false);
          }
      });
    }

    function editTableRow(obj){          
          var row_id = $(obj).attr('data-row'); 
          window.location.href = '/animals/'+row_id+'/edit';
      }

    </script>
    @endsection