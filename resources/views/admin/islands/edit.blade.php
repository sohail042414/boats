@extends('admin.layouts.adminlte')    
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Update Island/Bird</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/islands') }}">Islands/Birds</a></li>
          <li class="breadcrumb-item active">Update</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
<form autocomplete="off" role="form" style="width:100%" id="island-form" method="POST" action="{{ url('/islands/'.$island->id)}}" enctype="multipart/form-data">  
  <div class="row">
  <div class="col-md-12 col-lg-12 col-sm-12">
    @if ($errors->any())
        <div class="alert alert-danger">
            There are some errors, check each field carefully!
            {{--
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
      <div class="col-md-4 col-lg-4 col-sm-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Details</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              @csrf
              @method('PUT')
              <label for="name">Name</label>
              <input type="text" name="name" id="name" placeholder="Island/Bird Name" class="form-control" value="{{ old('name',$island->name) }}">
              @if($errors->has('name'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('name') }}</span>
              @endif
            </div>

            <div class="form-group">
              @csrf
              <label for="short_description">Short Description</label>
              <input type="text" name="short_description" id="short_description" placeholder="Short Description" class="form-control" value="{{ old('short_description',$island->short_description) }}">
              @if($errors->has('short_description'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('short_description') }}</span>
              @endif
            </div>
          
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description',$island->description) }}</textarea>
                @if($errors->has('description'))
                      <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('description') }}</span>
                @endif
            </div> 

            <div class="form-group">
                <input type="submit" name="Submit" value="Submit" class="btn btn-success">
                <a href="{{ url('/users') }}" style="margin:0px 10px;" class="btn btn-secondary">Cancel</a>
            </div>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      @include('/admin/islands/images')
  </div>
</form>
</section>
<!-- /.content -->
@endsection
@section('scripts')
    <script src="{{ asset('vendor/adminlte') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('vendor/adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
    $('.select2').select2();

    $(function() {
        $('#island-images-table').DataTable({
            processing: true,            
            serverSide: true,
            ajax: '{!! route("island-images-grid",["island_id"=>$island->id]) !!}',
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
            url: "{{ url('/island-images') }}/"+row_id,
            type: 'DELETE',
            success: function(response) {

              $(document).Toasts('create', {
                  title: 'Deletion Complete',
                  body: response.success,
                  class : 'bg-danger',
                  autohide:true,
                  delay : 3000,          
              });

              $('#island-images-table').DataTable().rows().invalidate('data').draw(false);
            }
        });
    }
</script>
@endsection