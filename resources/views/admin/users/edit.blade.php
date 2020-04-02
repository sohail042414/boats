@extends('admin.layouts.adminlte')    

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Update User "{{ $user->name }}"</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/users') }}">Users</a></li>
          <li class="breadcrumb-item active">Update </li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
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
      <form autocomplete="off" role="form" style="width:100%" id="ship-form" method="POST" action="{{ url('/users/'.$user->id)}}">  
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
              <label for="name">User Name</label>
              <input type="text" name="name" id="name" placeholder="User Name" class="form-control" value="{{ old('name',$user->name) }}">
              @if($errors->has('name'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('name') }}</span>
              @endif
            </div>
            
            <div class="form-group">
              <label for="ship-link">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="{{ old('email',$user->email) }}">
              @if($errors->has('email'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('email') }}</span>
              @endif
            </div>
          
            <div class="form-group">
                <label for="electricity">User Type</label>
                <select name="type" id="type" class="form-control custom-select">
                    <option selected disabled>Select one</option>  
                    @foreach ($user_types as $key => $item)
                        @if($key == old('type',$user->type))
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
                <input type="submit" name="Submit" value="Submit" class="btn btn-success">
                <a href="{{ url('/users') }}" style="margin:0px 10px;" class="btn btn-secondary">Cancel</a>
            </div>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </form>
      </div>
      <div class="col-md-6 col-lg-6 col-sm-12">
        <form autocomplete="off" role="form" style="width:100%" id="ship-form" method="POST" action="{{ url('/users/'.$user->id)}}" enctype="multipart/form-data">     
          <div class="card card-primary">        
          @csrf
          @method('PUT')
          <div class="card-header">
              <h3 class="card-title">Profile Image</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group">
                  <label for="exampleInputFile">Upload Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="profile_image" class="custom-file-input" id="profile_image">
                      <label class="custom-file-label" for="">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <input type="submit" value="Upload" name="upload_profile_image" class="btn btn-default btn-xs">
                        </span>
                    </div>
                    @if($errors->has('profile_image'))
                      <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('profile_image') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div cla="input-group">
                    <img class="img-fluid" src="{{ asset('/uploads/'.$user->image) }}" alt="User profile picture">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
        <!-- /.card -->
      </div>
  </div>
</section>
@endsection