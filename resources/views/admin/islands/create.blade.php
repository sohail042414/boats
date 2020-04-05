@extends('admin.layouts.adminlte')    
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add New Island</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/islands') }}">Islands</a></li>
          <li class="breadcrumb-item active">Create New</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
<form autocomplete="off" role="form" style="width:100%" id="ship-form" method="POST" action="{{ url('/islands')}}">  
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
      <div class="col-md-6 col-lg-6 col-sm-12">
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
              <label for="name">Name</label>
              <input type="text" name="name" id="name" placeholder="Island Name" class="form-control" value="{{ old('name','') }}">
              @if($errors->has('name'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('name') }}</span>
              @endif
            </div>
             

            <div class="form-group">
              @csrf
              <label for="short_description">Short Description</label>
              <input type="text" name="short_description" id="short_description" placeholder="Short Description" class="form-control" value="{{ old('short_description','') }}">
              @if($errors->has('short_description'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('short_description') }}</span>
              @endif
            </div>
          
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description','') }}</textarea>
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
  </div>
</form>
</section>
<!-- /.content -->
@endsection