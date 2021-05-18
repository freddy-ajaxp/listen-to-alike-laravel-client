<form id="form-add-link" name="form-add-link" class="form-horizontal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Link</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Title</label>
                    <div>
                        <input required type="text" class="form-control has-error" id="link_title" name="link_title" placeholder="title" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputDetail" class="col-sm-3 control-label">Video URL</label>
                    <div>

                        <input disabled type="text" class="form-control" id="video_embed_url" name="video_embed_url" placeholder="Video URL" value="">
                        <div class="form-check" style='margin:0.5em 1.5em 0 1em'>
                            <input class="form-check-input" type="checkbox" value="" id="checkbox">
                            <label class="form-check-label" for="defaultCheck1" style="font-size:13px">
                                Embed Video
                            </label>
                        </div>
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
                        <img id="image-preview-container-add" src="" style="max-height: 150px;  ">
                        <div>
                        <input id="image-add" class="music-link__upload-input" type="file" name="image" accept="image/*" />
                        </div>
                        <button id="clear-image-add" hidden> clear</button>
                    </div>
                    
                </div>
                {{-- <div>
                    <button type="button" name="add" id="add" class="btn btn-info btn-sm">Add New Row</button>
                </div>
                 --}}

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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-update" value="add">Add</button>
            </div>
        </div>
</form>
