<form id="form-platform-edit" name="form-platform" class="form-horizontal" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Logo Platform </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id" value="{{$data['id']}}">
                <input type="hidden" id="userErasingImage" value=false>
                <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Name</label>
                    <div>
                        <input required type="text"  disabled class="form-control has-error" id="link_title" name="link_title" placeholder="title" value="{{$data['platform_name']}}">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12 mb-2">
                    </div>
                    <label for="exampleInputFile">Logo (format .SVG / .PNG)</label>
                    <div class="music-link__upload-art">
                        <img id="image-preview-container-edit" src="https://res.cloudinary.com/dfpmdlf8l/image/upload/{{$data['logo_image_path']}}" style="max-height: 150px;" alt="">
                        <input id="image" class="music-link__upload-input" type="file" name="image"  accept="image/*"/>
                        <input type="hidden" id="userErasingImage" value=false>
                    </div>
                    @if($data['logo_image_path'])
                    <button id="clear-image-platform"> clear</button>
                    @else
                    <button id="clear-image-platform" hidden> clear</button>    
                    @endif
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-update" value="add">Update</button>
        </div>

    </div>
</form>
