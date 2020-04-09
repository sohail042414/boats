@extends('admin.layouts.adminlte')  

@section('styles')
<link rel="stylesheet" href="{{ asset('vendor/adminlte') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('vendor/adminlte') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('vendor/adminlte') }}/plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Update Itinerary</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/itineraries') }}">Itineraries</a></li>
          <li class="breadcrumb-item active">Update</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
<form autocomplete="off" role="form" style="width:100%" id="spot-form" method="POST" action="{{ url('/itineraries/'.$itinerary->id)}}" enctype="multipart/form-data">  
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
              @method('PUT')
              <label for="code">Code</label>
              <input type="text" name="code" id="code" placeholder="Itinerary Code like A2" class="form-control" value="{{ old('code',$itinerary->code) }}">
              @if($errors->has('code'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('code') }}</span>
              @endif
            </div>

            <div class="form-group">
              @csrf
              <label for="title">Title</label>
              <input type="text" name="title" id="title" placeholder="Itinerary Title" class="form-control" value="{{ old('title',$itinerary->title) }}">
              @if($errors->has('code'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('code') }}</span>
              @endif
            </div>
                       
            <div class="form-group">
                <label for="spots">Spots/Points</label>
                <select name="spots[]" id="spots" multiple="true" class="form-control select2">
                    @foreach ($spots_list as $key => $item)
                        @if(collect(old('spots'))->contains($key) || in_array($key,$itinerary_spots))
                          <option selected="selected" value="{{ $key }}">{{ $item }}</option>
                        @else
                          <option value="{{ $key }}">{{ $item }}</option>
                        @endif
                    @endforeach;
                </select>
                @if($errors->has('island_id'))
                      <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('island_id') }}</span>
                @endif
            </div> 
            
            <div class="form-group">
              @csrf
              <label for="start_date">Start Date</label>
              <input type="text" name="start_date" id="start_date" placeholder="Start Date" class="form-control" value="{{ old('start_date',$itinerary->start_date) }}">
              @if($errors->has('start_date'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('start_date') }}</span>
              @endif
            </div>

            <div class="form-group">
              @csrf
              <label for="end_date">End Date</label>
              <input type="text" name="end_date" id="end_date" placeholder="Start Date" class="form-control" value="{{ old('end_date',$itinerary->end_date) }}">
              @if($errors->has('end_date'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('end_date') }}</span>
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
@section('scripts')
    <script src="{{ asset('vendor/adminlte') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
    $('.select2').select2();
    $('#start_date').datepicker();
    $('#end_date').datepicker();
</script>
@endsection