@extends('admin.layouts.adminlte')    

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tours</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Tours</li>
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
              <a href="{{ url('/tours/create') }}" class="btn btn-success">Add New</a>            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tours-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Actions</th>
                  <th>Id</th>                  
                  <th>Title</th>
                  <th>Start Date</th>                        
                  <th>End Date</th>
                  <th>Nights</th>                        
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                  <th>Actions</th>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Start Date</th>                        
                  <th>End Date</th>  
                  <th>Nights</th>                          
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
        $('#tours-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('tours-grid') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },                
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                { data: 'nights', name: 'nights' },
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
          url: "{{ url('/tours') }}/"+row_id,
          type: 'DELETE',
          success: function(response) {

            $(document).Toasts('create', {
                title: 'Deletion Complete',
                body: response.success,
                class : 'bg-danger',
                autohide:true,
                delay : 3000,          
            });

            $('#tours-table').DataTable().rows().invalidate('data').draw(false);
          }
      });
    }

    function editTableRow(obj){          
          var row_id = $(obj).attr('data-row'); 
          window.location.href = '/tours/'+row_id+'/edit';
      }

    </script>
    @endsection