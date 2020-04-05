<div class="col-md-4 col-lg-4 col-sm-12">
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
            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('display_image') }}</span>
        @endif
    </div>
    <div cla="input-group">
            <img class="img-fluid" src="{{ asset('/uploads/'.$island->image) }}" alt="Photo">
    </div>
    </div>
    </div>

</div>
</div>
<div class="col-md-4 col-lg-4 col-sm-12">
<div class="card card-secondary">   
    <div class="card-header">
        <h3 class="card-title">Upload Additional Images</h3>
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
        <input type="file" name="additional_image" class="custom-file-input" id="additional_image">
        <label class="custom-file-label" for="">Choose file</label>
        </div>
        <div class="input-group-append">
        <span class="input-group-text">
            <input type="submit" value="Upload" name="upload_additional_image" class="btn btn-default btn-xs">
        </span>
        </div>
        @if($errors->has('additional_image'))
            <span style="display:block;" class="error invalid-feedback"> {{ $errors->first('additional_image') }}</span>
        @endif
    </div>
    <table id="island-images-table" class="table table-bordered table-hover">
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