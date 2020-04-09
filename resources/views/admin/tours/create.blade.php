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
        <h1>Add New Tour</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/tours') }}">Tours</a></li>
          <li class="breadcrumb-item active">Create New</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
<form autocomplete="off" role="form" style="width:100%" id="ship-form" method="POST" action="{{ url('/tours')}}">  
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
                <label for="itinerary_id">Itinerary</label>
                <select name="itinerary_id" id="itinerary_id" class="form-control custom-select">
                    <option selected disabled>Select one</option>  
                    @foreach ($itineraries_list as $key => $item)
                        @if($key == old('itinerary_id'))
                          <option selected="selected" value="{{ $key }}">{{ $item }}</option>
                        @else
                          <option value="{{ $key }}">{{ $item }}</option>
                        @endif
                    @endforeach;
                </select>
                @if($errors->has('itinerary_id'))
                      <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('itinerary_id') }}</span>
                @endif
            </div> 
            <div class="form-group">
                <label for="ship_id">Ship</label>
                <select name="ship_id" id="ship_id" class="form-control custom-select">
                    <option selected disabled>Select one</option>  
                    @foreach ($ships_list as $key => $item)
                        @if($key == old('ship_id'))
                          <option selected="selected" value="{{ $key }}">{{ $item }}</option>
                        @else
                          <option value="{{ $key }}">{{ $item }}</option>
                        @endif
                    @endforeach;
                </select>
                @if($errors->has('ship_id'))
                      <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('ship_id') }}</span>
                @endif
            </div> 

            <div class="form-group">
              @csrf
              <label for="title">Title</label>
              <input type="text" name="title" id="title" placeholder="8 days East Carabian" class="form-control" value="{{ old('title','') }}">
              @if($errors->has('title'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('title') }}</span>
              @endif
            </div>

            <div class="form-group">
                <label for="details">Details</label>
                <textarea name="details" id="details" class="form-control" rows="4">{{ old('details') }}</textarea>
                @if($errors->has('details'))
                      <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('details') }}</span>
                @endif
            </div> 


            <div class="form-group">
              @csrf
              <label for="start_date">Start Date</label>
              <input type="text" name="start_date" id="start_date" placeholder="Start Date" class="form-control" value="{{ old('start_date','') }}">
              @if($errors->has('start_date'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('start_date') }}</span>
              @endif
            </div>

            <div class="form-group">
              @csrf
              <label for="end_date">Start Date</label>
              <input type="text" name="end_date" id="end_date" placeholder="Start Date" class="form-control" value="{{ old('end_date','') }}">
              @if($errors->has('end_date'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('end_date') }}</span>
              @endif
            </div>

            <div class="form-group">              
              <label for="nights">Nights</label>
              <input type="text" name="nights" id="nights" placeholder="8" class="form-control" value="{{ old('nights','') }}">
              @if($errors->has('nights'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('nights') }}</span>
              @endif
            </div>
                 
            <div class="form-check">
                <input type="checkbox" value="1" checked name="available" class="form-check-input" id="available">
                <label class="form-check-label" for="available">Available</label>
            </div>
            
            <div class="form-check">
                <input type="checkbox" value="1" name="on_hold" class="form-check-input" id="on_hold">
                <label class="form-check-label" for="on_hold">On Hold</label>
            </div>

            <div class="form-group">              
              <label for="current_gross_rate">Current Gross Rate</label>
              <input type="text" name="current_gross_rate" id="current_gross_rate" placeholder="60" class="form-control" value="{{ old('current_gross_rate','') }}">
              @if($errors->has('current_gross_rate'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('current_gross_rate') }}</span>
              @endif
            </div>
                 
            <div class="form-group">              
              <label for="original_gross_rate">Original Gross Rate</label>
              <input type="text" name="original_gross_rate" id="original_gross_rate" placeholder="60" class="form-control" value="{{ old('original_gross_rate','') }}">
              @if($errors->has('original_gross_rate'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('original_gross_rate') }}</span>
              @endif
            </div>

            <div class="form-group">              
              <label for="current_net_rate">Current Net Rate</label>
              <input type="text" name="current_net_rate" id="current_net_rate" placeholder="60" class="form-control" value="{{ old('current_net_rate','') }}">
              @if($errors->has('current_net_rate'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('current_net_rate') }}</span>
              @endif
            </div>

            <div class="form-group">              
              <label for="original_net_rate">Original Net Rate</label>
              <input type="text" name="original_net_rate" id="original_net_rate" placeholder="60" class="form-control" value="{{ old('original_net_rate','') }}">
              @if($errors->has('current_net_rate'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('original_net_rate') }}</span>
              @endif
            </div>

            <div class="form-group">              
              <label for="promotion">Promotion</label>
              <input type="text" name="promotion" id="promotion" placeholder="60" class="form-control" value="{{ old('promotion','') }}">
              @if($errors->has('promotion'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('promotion') }}</span>
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