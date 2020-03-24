@extends('admin.layouts.adminlte')    

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Boat Types</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Boat Types</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="col-lg-7 col-md-7 col-sm-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">All Types</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="boats-types-table" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>    
              </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>    
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->        
      <div class="col-md-5 col-lg-5 col-sm-12">
          <div id="create-row-card" class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add New</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create-form" action="{{ url('/boat-types') }}" role="form" method="POST">
              @csrf
              
              <div class="card-body">
                
                <div class="form-group">
                  <label for="boat-type-name">Name</label>
                  <input name="boat_type_name" type="text" class="form-control" id="boat-type-name" placeholder="Luxury ">
                </div>

                <div class="form-group">
                  <label for="boat-type-description">Description</label>
                  <input name="boat_type_description" type="text" class="form-control" id="boat-type-description" placeholder="Short description ">
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
              <h3 class="card-title">Update Record</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="edit-form" action="{{ url('/boat-types') }}" role="form" method="PUT">
              @csrf
              
              <div class="card-body">
                
                <div class="form-group">
                  <input name="id" type="hidden" id="edit-id">
                  <label for="boat-type-name">Name</label>
                  <input name="name" type="text" class="form-control" id="edit-name" placeholder="Luxury ">
                </div>

                <div class="form-group">
                  <label for="boat-type-description">Description</label>
                  <input name="description" type="text" class="form-control" id="edit-description" placeholder="Short description ">
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
        $('#boats-types-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('boat-types-grid') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'id', name: 'id' }
            ],
            columnDefs : [
              {
                "targets" : 3,
                "data": "img",
                "render" : function (data,type,row) {
                    var col_html = '<button type="button" data-row="'+row.id+'" class="btn btn-info btn-sm mr-1" onclick="editTableRow(this)"  >Edit</button>';
                    col_html += '<button type="button" class="btn btn-danger btn-sm" onclick="deleteTableRow('+data+')"  >Delete</button>';
                    return col_html;
                  }
              }
            ]
        });
    });

    function deleteTableRow(row_id){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('/boat-types') }}/"+row_id,
            type: 'DELETE',
            success: function(response) {

              $(document).Toasts('create', {
                  title: 'Deletion Complete',
                  body: response.success,
                  class : 'bg-danger',
                  autohide:true,
                  delay : 3000,          
              });

              $('#boats-types-table').DataTable().rows().invalidate('data').draw(false);
            }
        });
        }

        function editTableRow(obj){
          
          var row_id = $(obj).attr('data-row');
          var table =  $('#boats-types-table').DataTable();
          var tr = $(obj).closest('tr');
          var row = table.row(tr);
          var boat_class_id = row.data().id;
          var boat_class_name = row.data().name;
          var boat_class_description = row.data().description;
          $('#create-row-card').hide();
          $('#edit-row-card').show();
          $('#edit-id').val(boat_class_id);
          $('#edit-name').val(boat_class_name);        
          $('#edit-description').val(boat_class_description);    

        }

        function resetForms(){      
          $('#create-row-card').show();
          $('#edit-row-card').hide();
          $('#edit-name').val('');
          $('#edit-description').val('');
          $('#edit-id').val('');
        }

        function updateTableRow(){

          var formData ={ 
              name : $('#edit-name').val(),
              description : $('#edit-description').val(),
              id : $('#edit-id').val()
            };

            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
              url: "{{ url('/boat-types') }}/"+$('#edit-id').val(),
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

                $('#boats-types-table').DataTable().rows().invalidate('data').draw(false);
              }
          });
        }

    </script>
    @endsection