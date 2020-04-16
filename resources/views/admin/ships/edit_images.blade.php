<form role="form" style="width:100%" id="ship-form" method="POST" action="{{ url('/ships/'.$ship->id) }}" enctype="multipart/form-data">
    @csrf 
    @method('PUT')
    <input type="hidden" name="tab" value="images">
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Upload Display Image</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputFile">Upload Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="display_image" class="custom-file-input" id="display_image">
                                <label class="custom-file-label" for="">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">
                            <input type="submit" value="Upload" name="upload_display_image" class="btn btn-default btn-xs">
                            </span>
                            </div>
                            @if($errors->has('display_image'))
                            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('display_image') }}</span> @endif
                        </div>
                        <div cla="input-group">
                            <img class="img-fluid" src="{{ asset('/uploads/'.$ship->image) }}" alt="Photo">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Additional Images</h3>
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
                                        <input type="file" name="additional_image" class="custom-file-input" id="additional_image">
                                        <label class="custom-file-label" for="">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                <input type="submit" value="Upload" name="upload_additional_image" class="btn btn-default btn-xs">
                                </span>
                                    </div>
                                    @if($errors->has('additional_image'))
                                    <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('additional_image') }}</span> @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <table id="ship-images-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id </th>
                                        <th>Image</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id </th>
                                        <th>Image</th>
                                        <th>Delete</th>
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