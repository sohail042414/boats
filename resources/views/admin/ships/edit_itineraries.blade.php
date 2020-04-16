<form role="form" style="width:100%" id="ship-form" method="POST" action="{{ url('/itineraries') }}" >
    @csrf 
    <div class="row">
        <div class="col-md-5 col-lg-5 col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Itinerary | ship # {{ $ship->id }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                  <div class="card-body">
                    <input type="hidden" name="ship_id" value="{{ $ship->id }}">
                    <input type="hidden" name="tab" value="itineraries">
                    <div class="form-group">                        
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
                        <select name="spots[]" id="spots" multiple="true" class="select2 form-control">
                            @foreach ($spots_list as $key => $item) @if(collect(old('spots'))->contains($key) || in_array($key,$itinerary_spots))
                            <option selected="selected" value="{{ $key }}">{{ $item }}</option>
                            @else
                            <option value="{{ $key }}">{{ $item }}</option>
                            @endif @endforeach;
                        </select>
                        @if($errors->has('island_id'))
                        <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('island_id') }}</span> @endif
                    </div>

                    <div class="form-group">
                        @csrf
                        <label for="start_date">Start Date</label>
                        <input type="text" name="start_date" id="start_date" placeholder="Start Date" class="form-control" value="{{ old('start_date',$itinerary->start_date) }}"> @if($errors->has('start_date'))
                        <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('start_date') }}</span> @endif
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
        <div class="col-md-7 col-lg-7 col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Itineraries</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <table id="ship-itineraries-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Id</th>
                                    <th>Code</th>
                                    <th>Title</th>
                                    <th>Start Date</th>                        
                                    <th>End Date</th>                        
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Actions</th>
                                    <th>Id</th>
                                    <th>Code</th>
                                    <th>Title</th>
                                    <th>Start Date</th>                        
                                    <th>End Date</th>                        
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>