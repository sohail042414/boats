<form role="form" style="width:100%" id="ship-form" method="POST" action="{{ url('/ships/'.$ship->id) }}" enctype="multipart/form-data">
@csrf 
@method('PUT')
<input type="hidden" name="tab" value="general">
  <div class="row">
      <div class="col-md-6 col-lg-6 col-sm-12">
        <div class="card card-primary" style="min-height:900px;">
            <div class="card-header">
                <h3 class="card-title">Details</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" name="name" id="name" placeholder="Ship Name" class="form-control" value="{{ old('name',$ship->name) }}"> @if($errors->has('name'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('name') }}</span> @endif
                </div>

                <div class="form-group" style="display:none;">
                    <label for="inputName">Image</label>
                    <input type="text" name="image" id="image" class="form-control" value="{{ old('image',$ship->image) }}">
                </div>

                <div class="form-group">
                    <label for="ship-link">Ship Link</label>
                    <input type="text" name="ship_link" id="ship-link" class="form-control" value="{{ old('ship_link',$ship->ship_link) }}"> @if($errors->has('ship_link'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('ship_link') }}</span> @endif
                </div>

                <div class="form-group">
                    <label for="short-description">Short Description</label>
                    <textarea name="short_description" id="short-description" class="form-control" rows="4">{{ old('short_description',$ship->short_description) }}</textarea>
                    @if($errors->has('short_description'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('short_description') }}</span> @endif
                </div>

                <div class="form-group">
                    <label for="title_description_1">Title Description 1</label>
                    <textarea name="title_description_1" id="title-description-1" class="form-control" rows="4">{{ old('title_description_1',$ship->title_description_1) }}</textarea>
                    @if($errors->has('title_description_1'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('title_description_1') }}</span> @endif
                </div>

                <div class="form-group">
                    <label for="inputDescription">Title Description 2</label>
                    <textarea name="title_description_2" id="title-description-2" class="form-control" rows="4">{{ old('title_description_2',$ship->title_description_2) }}</textarea>
                    @if($errors->has('title_description_2'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('title_description_2') }}</span> @endif
                </div>

                <div class="form-group">
                    <label for="inputDescription">Title Description 3</label>
                    <textarea name="title_description_3" id="title-description-3" class="form-control" rows="4">{{ old('title_description_3',$ship->title_description_3) }}</textarea>
                    @if($errors->has('title_description_3'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('title_description_3') }}</span> @endif
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-6 col-lg-6 col-sm-12">
        <div class="card card-secondary" style="min-height:900px;">
            <div class="card-header">
                <h3 class="card-title">Spefications</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="ship-type">Amenities</label>
                    <select name="amenities[]" id="amenities" multiple="true" class="select2 form-control">
                        @foreach ($amenities as $item) @if(collect(old('amenities'))->contains($item->id) || in_array($item->id,$ship_amenities)))
                        <option selected="selected" value="{{ $item->id }}">{{ $item->name }}</option>
                        @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif @endforeach;
                    </select>
                    @if($errors->has('amenities'))
                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('amenities') }}</span> @endif
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="ship-type">Ship Type</label>
                            <select name="ship_type" id="ship-type" class="form-control custom-select">
                                <option selected disabled>Select one</option>
                                @foreach ($ship_types as $item) @if($item->id == old('ship_type',$ship->ship_type))
                                <option selected="selected" value="{{ $item->id }}">{{ $item->name }}</option>
                                @else
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif @endforeach;
                            </select>
                            @if($errors->has('ship_type'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('ship_type') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="cruise-category">Cruise Category</label>
                            <select name="cruise_category" id="cruise-category" class="form-control custom-select">
                                <option selected disabled>Select one</option>
                                @foreach ($cruise_cats as $item) @if($item->id == old('cruise_category',$ship->cruise_category))
                                <option selected="selected" value="{{ $item->id }}">{{ $item->name }}</option>
                                @else
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif @endforeach;
                            </select>
                            @if($errors->has('cruise_category'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('cruise_category') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="capacity-category">Capacity Category</label>
                            <select name="capacity_category" id="capacity-category" class="form-control custom-select">
                                <option selected disabled>Select one</option>
                                @foreach ($capacity_cats as $item) @if($item->id == old('capacity_category',$ship->capacity_category))
                                <option selected="selected" value="{{ $item->id }}">{{ $item->name }}</option>
                                @else
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif @endforeach;
                            </select>
                            @if($errors->has('capacity_category'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('capacity_category') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price',$ship->price) }}"> @if($errors->has('price'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('price') }}</span> @endif
                        </div>
                        <div class="form-group">
                            <label for="capacity">Capacity</label>
                            <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity',$ship->capacity) }}"> @if($errors->has('capacity'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('capacity') }}</span> @endif
                        </div>
                        <div class="form-group">
                            <label for="year-built">Year Built</label>
                            <input type="number" name="year_built" id="year-built" class="form-control" value="{{ old('year_built',$ship->year_built) }}"> @if($errors->has('year_built'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('year_built') }}</span> @endif
                        </div>
                        <div class="form-group">
                            <label for="year-renovated">Year Renovated</label>
                            <input type="number" name="year_renovated" id="year-renovated" class="form-control" value="{{ old('year_renovated',$ship->year_renovated) }}"> @if($errors->has('year_renovated'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('year_renovated') }}</span> @endif
                        </div>
                        <div class="form-group">
                            <label for="length">Length</label>
                            <input type="text" name="length" id="length" class="form-control" value="{{ old('length',$ship->length) }}"> @if($errors->has('length'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('length') }}</span> @endif
                        </div>
                        <div class="form-group">
                            <label for="beam">Beam</label>
                            <input type="text" name="beam" id="beam" class="form-control" value="{{ old('beam',$ship->beam) }}"> @if($errors->has('beam'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('beam') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="draft">Draft</label>
                            <input type="text" name="draft" id="draft" class="form-control" value="{{ old('draft',$ship->draft) }}"> @if($errors->has('draft'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('draft') }}</span> @endif
                        </div>
                        <div class="form-group">
                            <label for="engines">Engines</label>
                            <input type="text" name="engines" id="engines" class="form-control" value="{{ old('engines',$ship->engines) }}"> @if($errors->has('engines'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('engines') }}</span> @endif
                        </div>

                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="top-spead">Top Speed</label>
                            <input type="number" name="top_speed" id="top-spead" class="form-control" value="{{ old('top_speed',$ship->top_speed) }}"> @if($errors->has('top_speed'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('top_speed') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="crusing-spead">Crusing Speed</label>
                            <input type="number" name="crusing_speed" id="crusing-speed" class="form-control" value="{{ old('crusing_speed',$ship->crusing_speed) }}"> @if($errors->has('crusing_speed'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('crusing_speed') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="cabins"> No of Cabins</label>
                            <input type="number" name="cabins" id="cabins" class="form-control" value="{{ old('cabins',$ship->cabins) }}"> @if($errors->has('cabins'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('cabins') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="bathrooms">No of Bathrooms</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ old('bathrooms',$ship->bathrooms) }}"> @if($errors->has('bathrooms'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('bathrooms') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="electricity">Electricity</label>
                            <select name="electricity" id="electricity" class="form-control custom-select">
                                <option selected disabled>Select one</option>
                                @foreach ($electricty_options as $key => $item) @if($key == old('electricity',$ship->electricity))
                                <option selected="selected" value="{{ $key }}">{{ $item }}</option>
                                @else
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endif @endforeach;
                            </select>
                            @if($errors->has('electricity'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('electricity') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="gross-tonnage">Gross Tonnage</label>
                            <input type="text" name="gross_tonnage" id="gross-tonnage" class="form-control" value="{{ old('gross_tonnage',$ship->gross_tonnage) }}"> @if($errors->has('gross_tonnage'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('gross_tonnage') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="water-capacity">Water Capacity</label>
                            <input type="text" name="water_capacity" id="water-capacity" class="form-control" value="{{ old('water_capacity',$ship->water_capacity) }}"> @if($errors->has('water_capacity'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('water_capacity') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="fuel-capacity">Fuel Capacity</label>
                            <input type="text" name="fuel_capacity" id="fuel-capacity" class="form-control" value="{{ old('fuel_capacity',$ship->fuel_capacity) }}"> @if($errors->has('fuel_capacity'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('fuel_capacity') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="fresh-water-maker">Fresh Water Maker</label>
                            <input type="text" name="fresh_water_maker" id="fresh-water-maker" class="form-control" value="{{ old('fresh_water_maker',$ship->fresh_water_maker) }}"> @if($errors->has('fresh_water_maker'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('fresh_water_maker') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="tenders">Tenders</label>
                            <input type="text" name="tenders" id="tenders" class="form-control" value="{{ old('tenders',$ship->tenders) }}"> @if($errors->has('tenders'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('tenders') }}</span> @endif
                        </div>

                        <div class="form-group">
                            <label for="safety">Safety</label>
                            <input type="text" name="safety" id="safety" class="form-control" value="{{ old('safety',$ship->safety) }}"> @if($errors->has('safety'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('safety') }}</span> @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" name="update_ship" value="Update" class="btn btn-success">
                        <a href="/ships" style="margin:0px 10px;" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
  </div>
</form>