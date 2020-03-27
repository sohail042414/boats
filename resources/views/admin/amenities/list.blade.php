@extends('admin.layouts.adminlte')    

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Amenities</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Amenities</li>
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
              <h3 class="card-title">All amenities</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="amenities-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th> 
                  <th>Actions</th>                        
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
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
              <form action="{{ url('/amenities') }}" role="form" method="POST">
                @csrf
                
                <div class="card-body">
                  <div class="form-group">
                    <label for="amenity-name">Name</label>
                    <input name="amenity_name" type="text" class="form-control" id="amenity-name" placeholder="Some good feature">
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

            <div id="edit-row-card" class="card card-primary" style="display:none;">
                <div class="card-header">
                  <h3 class="card-title">Update Amenity</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
              <form action="{{ url('/amenities') }}" role="form" method="">
                @csrf                
                <div class="card-body">
                  <div class="form-group">
                    <label for="amenity-name">Name</label>
                    <input name="edit_id" type="hidden" id="edit-id">
                    <input name="edit_name" type="text" class="form-control" id="edit-name" placeholder="Some good feature">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" onclick="updateAmenity()" class="btn btn-primary">Update</button>
                  <button type="button" onclick="resetAmenityForms()" class="btn btn-info">Clear</button>
                </div>
              </form>
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
        $('#amenities-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('amenities-grid') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'id', name: 'id' }
            ],           
            columnDefs : [
              {
                "targets" : 2,
                "data": "img",
                "render" : function (data,type,row) {
                    var col_html = '<button type="button" data-row="'+row.id+'" class="btn btn-info btn-sm mr-1" onclick="editAmenity(this)"  >Edit</button>';
                    col_html += '<button type="button" class="btn btn-danger btn-sm" onclick="deleteAmenity('+data+')"  >Delete</button>';
                    return col_html;
                  }
              }
            ]
        });
    });

    function deleteAmenity(row_id){
      
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
          url: "{{ url('/amenities') }}/"+row_id,
          type: 'DELETE',
          success: function(response) {

            $(document).Toasts('create', {
                title: 'Deletion Complete',
                body: response.success,
                class : 'bg-danger',
                autohide:true,
                delay : 3000,          
            });

            $('#amenities-table').DataTable().rows().invalidate('data').draw(false);
          }
      });
    }

    function editAmenity(obj){

      var row_id = $(obj).attr('data-row');
      var table =  $('#amenities-table').DataTable();
      var tr = $(obj).closest('tr');
      var row = table.row(tr);
      var amenity_id = row.data().id;
      var amenity_name = row.data().name;
      $('#create-row-card').hide();
      $('#edit-row-card').show();
      $('#edit-name').val(amenity_name);
      $('#edit-id').val(amenity_id);

    }

    function resetAmenityForms(){
              
        $('#create-row-card').show();
        $('#edit-row-card').hide();
        $('#edit-name').val('');
        $('#edit-id').val('');
    }

    function updateAmenity(){

      var formData ={ 
          amenity_name : $('#edit-name').val(),
          amenity_id : $('#edit-id').val()
        };

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
          url: "{{ url('/amenities') }}/"+$('#edit-id').val(),
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

            resetAmenityForms();

            $('#amenities-table').DataTable().rows().invalidate('data').draw(false);
          }
      });

    }

    </script>
    @endsection