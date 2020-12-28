<form id="form-platform" name="form-platform" class="form-horizontal" novalidate="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Link </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Title</label>
                    <div>
                        <input type="text" class="form-control has-error" id="link_title" name="link_title" placeholder="title" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Link</label>
                    <div>
                        <input disabled type="text" class="form-control has-error" id="short_link" name="short_link" placeholder="link" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDetail" class="col-sm-3 control-label">Video URL</label>
                    <div>
                        <input type="text" class="form-control" id="video_embed_url" name="video_embed_url" placeholder="Video URL" value="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 mb-2">
                    </div>
                    <label for="inputDetail" class="col-sm-3 control-label">Image</label>
                    <div class="music-link__upload-art">
                        <ion-icon name="download-outline" />
                        <b style=" font-weight: 500; margin-bottom: '0.5em'">
                            Upload Image
                        </b>
                        <p style="font-size: '0.8em'; opacity: '0.8' ">
                            jpg | jpeg | png <br> Max 10MB <br> Drop file here.
                        </p>
                        <img id="image-preview-container" src="" style="max-height: 150px;">
                        <input id="image" class="music-link__upload-input" type="file" name="image" accept="image/*" />
                    </div>
                    <button id="clear-image" hidden> clear</button>
                </div>
                <div>
                    <button type="button" name="add" id="add" class="btn btn-info btn-sm">Add New Row</button>
                </div>
                <table class="table table-borderless " id="user_table">
                    <tbody id="select-master">                            
                    </tbody>
                </table>
                <div id="modal-dynamic-form">
                @include('components/user/partials/select-platform')
                {{-- ini untuk yg lama, yg baru dari select-platform --}}
                    {{-- @foreach ($result as $index =>$dt)
                    <div class="form-group">
                        <input type="hidden" name="id_platforms[]" value={{$dt['id']}} />
                        <div class="form-row">
                            <div class="col-sm-2">
                                <select id="data_platform{{$index}}" name="data_platform[]" class="form-control form-control-sm">
                                    <option disabled selected value=null>Platform</option>
                                    @foreach($platforms as $key => $platform)
                                    <option value="{{$platform['platform_name']}}">{{$platform['platform_name']}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="data_url_platform[]" class="form-control form-control-sm" placeholder="URL dari platform" value="{{ $dt['url_platform'] }}" />
                            </div>
                            <div class="col-sm-2">
                                <select id="data_text{{$index}}" name="data_text[]" class="music-link__button-text-select">
                                    @foreach($texts as $index => $text)
                                    <option value="{{$text['text']}}">{{$text['text']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" name="remove" id="" class="btn btn-danger btn-sm remove">X</button>
                            </div>
                        </div>

                    </div>
                    @endforeach --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-update" value="add">Update</button>
                </div>

            </div>
</form>
