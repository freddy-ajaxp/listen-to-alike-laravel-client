<form id="form-platform" name="form-platform" class="form-horizontal" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Link </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id" value="{{$link['id']}}">
                <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Title</label>
                    <div>
                        <input required  type="text" class="form-control has-error" id="link_title" name="link_title" placeholder="title" value="{{$link['title']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Link</label>
                    <div>
                        <input disabled type="text" class="form-control has-error" id="short_link" name="short_link" placeholder="link" value="{{$link['short_link']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDetail" class="col-sm-3 control-label">Video URL</label>
                    <div>
                        <input type="text" class="form-control" id="video_embed_url" name="video_embed_url" placeholder="Video URL" value="{{$link['video_embed_url']}}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 mb-2">
                    </div>
                    <label for="inputDetail" class="col-sm-3 control-label">Image</label>
                    <div class="music-link__upload-art">
                        <ion-icon name="download-outline" />
                        <div id="upload-text">
                            <b style=" font-weight: 500; margin-bottom: '0.5em'">
                                Upload Image
                            </b>
                            <p style="font-size: '0.8em'; opacity: '0.8' ">
                                jpg | jpeg | png <br> Max 10MB <br> Drop file here.
                            </p>
                        </div>
                        @if($link['image_path'])
                            <img id="image-preview-container" src="https://res.cloudinary.com/dfpmdlf8l/image/upload/{{$link['image_path']}}.jpg" style="max-height: 150px;" alt="">    
                        @else
                        <img id="image-preview-container" src="" style="max-height: 150px;" alt="">
                        @endif
                        
                        <input id="image" class="music-link__upload-input" type="file" name="image" accept="image/*" />
                        <input type="hidden" id="userErasingImage" value=false>
                         @if($link['image_path'])
                    <button id="clear-image"> clear</button>
                    @else
                    <button id="clear-image" hidden> clear</button>    
                    @endif
                    </div>
                   
                </div>
                <div class="music-link__platforms" id="dynamic_platform">
                {{-- <button type="button" name="add" id="add" class="btn btn-outline-secondary">Add New Row</button> --}}
                <div class="btn-group mr-2" id="BtnAddPlatformContainer">   
                    <button id="BtnAddPlatform" type="button" class="music-link__add-link btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Add a platform
                    </button>
                    <div id="selectAddPlatform" class="dropdown-menu music-link__add-link__dropdown">
                        <h6 class="dropdown-header">Platforms</h6>
                        @foreach($platforms as $key => $platform)
                            <a class="dropdown-item" data-platform="{{$platform['id']}}" data-id-platform="{{$platform['id']}}" data-img="{{$platform['logo_image_path']}}">{{$platform['platform_name']}}</a>
                        @endforeach
                        </div> 
                </div>
                <hr/>
                <div id="modal-dynamic-form">
                    @include('components/user/partials/select-platform')
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-update" value="add">Update</button>
        </div>

    </div>
</form>
