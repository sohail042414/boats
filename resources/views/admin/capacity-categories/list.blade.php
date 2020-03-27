@extends('admin.layouts.adminlte')    

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Cruise Capacity Categories</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Capacity Categories</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">

      <div class="col-md-7 col-lg-7 col-sm-12">
            <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">All Categories</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="capacity-categories-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Actions</th>     
                  <th>Id</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Min</th>
                  <th>Max</th>
                 </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                  <th>Actions</th> 
                  <th>Id</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Min</th>
                  <th>Max</th>    
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>


          <div class="col-md-5 col-lg-5 col-sm-12">
             <div id="create-row-card" class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('/capacity-categories') }}" role="form" method="POST">
                @csrf
                
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="add-name">Name</label>
                    <input name="name" type="text" class="form-control" id="add-name" value="{{ old('name','') }}" placeholder="Luxury ">
                  </div>

                  <div class="form-group">
                    <label for="add-description">Description</label>
                    <input name="description" type="text" class="form-control" id="add-description" value="{{ old('description','') }}" placeholder="Short description ">
                  </div>

                  <div class="form-group">
                    <label for="add-min">Min</label>
                    <input name="min" type="number" class="form-control" id="add-min" min="0" value="{{ old('min','') }}">
                  </div>

                  <div class="form-group">
                    <label for="add-max">Max</label>
                    <input name="max" type="number" class="form-control" id="add-min" min="0" value="{{ old('max','') }}">
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          

          <div id="edit-row-card" style="display:none;" class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Row</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('/capacity-categories') }}" role="form" method="POST">
                @csrf
                
                <div class="card-body">
                  
                  <div class="form-group">
                    <input name="boat_class_id" type="hidden" id="edit-id">
                    <label for="edit-name">Name</label>
                    <input name="edit_name" type="text" class="form-control" id="edit-name" placeholder="Luxury ">
                  </div>

                  <div class="form-group">
                    <label for="boat-class-description">Description</label>
                    <input name="edit_description" type="text" class="form-control" id="edit-description" placeholder="Short description ">
                  </div>

                  <div class="form-group">
                    <label for="add-min">Min</label>
                    <input name="edit_min" type="number" class="form-control" id="edit-min" min="0">
                  </div>

                  <div class="form-group">
                    <label for="add-max">Min</label>
                    <input name="edit_max" type="number" class="form-control" id="edit-max" min="0">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" onclick="updateTableRow()" class="btn btn-primary">Update</button>
                  <button type="button" onclick="resetForms()" class="btn btn-info">Clear</button>
                </div>
              </form>
            </div>
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
        $('#capacity-categories-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('capacity-categories-grid') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'min', name: 'min' },
                { data: 'max', name: 'max' },
            ],
            columnDefs : [
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
                    col_html += '<a class="dropdown-item bg-gradient-primary" data-row="'+row.id+'" onclick="editTableRow(this)" href="/ships/edit/'+row.id+'">Edit</a>';
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
            url: "{{ url('/capacity-categories') }}/"+row_id,
            type: 'DELETE',
            success: function(response) {

              $(document).Toasts('create', {
                  title: 'Deletion Complete',
                  body: response.success,
                  class : 'bg-danger',
                  autohide:true,
                  delay : 3000,          
              });

              $('#capacity-categories-table').DataTable().rows().invalidate('data').draw(false);
            }
        });
      }

      function editTableRow(obj){
          
          var row_id = $(obj).attr('data-row');
          var table =  $('#capacity-categories-table').DataTable();
          var tr = $(obj).closest('tr');
          var row = table.row(tr);
          // var boat_class_id = row.data().id;
          // var boat_class_name = row.data().name;
          // var boat_class_description = row.data().description;
          $('#create-row-card').hide();
          $('#edit-row-card').show();
          $('#edit-id').val(row.data().id);
          $('#edit-name').val(row.data().name);        
          $('#edit-description').val(row.data().description);
          $('#edit-min').val(row.data().min);
          $('#edit-max').val(row.data().max);    

      }

      function resetForms(){      
          $('#create-row-card').show();
          $('#edit-row-card').hide();
          $('#edit-name').val('');
          $('#edit-id').val('');
      }

      function updateTableRow(){

          var formData ={ 
              name : $('#edit-name').val(),
              description : $('#edit-description').val(),
              min : $('#edit-min').val(),
              max : $('#edit-max').val(),
              id : $('#edit-id').val()
            };

            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
              url: "{{ url('/capacity-categories') }}/"+$('#edit-id').val(),
              type: 'PUT',
              data : formData,
              success: function(response) {

                $(document).Toasts('create', {
                    title: 'Update Complete',
                    body: response.success,
                    class : 'bg-success',
                    autohide:true,
                    delay : 3000,                
                });
                resetForms();

                $('#capacity-categories-table').DataTable().rows().invalidate('data').draw(false);
              }
          });
      }
    </script>
    @endsection