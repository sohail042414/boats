@extends('admin.layouts.adminlte')    
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add New User</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/users') }}">Users</a></li>
          <li class="breadcrumb-item active">Create New</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
<form autocomplete="off" role="form" style="width:100%" id="ship-form" method="POST" action="{{ url('/users')}}">  
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
              <label for="name">User Name</label>
              <input type="text" name="name" id="name" placeholder="User Name" class="form-control" value="{{ old('name','') }}">
              @if($errors->has('name'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('name') }}</span>
              @endif
            </div>
            
            <div class="form-group">
              <label for="ship-link">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="{{ old('email','') }}">
              @if($errors->has('email'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('email') }}</span>
              @endif
            </div>
          
            <div class="form-group">
                <label for="electricity">User Type</label>
                <select name="type" id="type" class="form-control custom-select">
                    <option selected disabled>Select one</option>  
                    @foreach ($user_types as $key => $item)
                        @if($key == old('type',''))
                          <option selected="selected" value="{{ $key }}">{{ $item }}</option>
                        @else
                          <option value="{{ $key }}">{{ $item }}</option>
                        @endif
                    @endforeach;
                </select>
                @if($errors->has('type'))
                      <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('type') }}</span>
                @endif
            </div> 

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
              @if($errors->has('password'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('password') }}</span>
              @endif
            </div>

            <div class="form-group">
              <label for="confirm_password">Confirm Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="" >
              @if($errors->has('password_confirmation'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('password') }}</span>
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