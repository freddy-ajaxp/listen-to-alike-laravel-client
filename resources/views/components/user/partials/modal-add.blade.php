<form id="form-add-link" name="form-add-link" class="form-horizontal" >
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
                        <input type="text" class="form-control has-error" id="link_title" name="link_title" placeholder="title" value="">
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
                        <div id="upload-text">
                        <b style=" font-weight: 500; margin-bottom: '0.5em'">
                            Upload Image
                        </b>
                        <p style="font-size: '0.8em'; opacity: '0.8' ">
                            jpg | jpeg | png <br> Max 10MB <br> Drop file here.
                        </p>
                        </div>
                        <img id="image-preview-container-add" src="" style="max-height: 150px;">
                        <input id="image-add" class="music-link__upload-input" type="file" name="image" accept="image/*" />
                    </div>
                    <button id="clear-image-add" hidden> clear</button>
                </div>
                <div>
                    <button type="button" name="add" id="add" class="btn btn-info btn-sm">Add New Row</button>
                </div>

                {{-- <table class="table table-borderless " id="user_table">
            <tbody id="select-master">                            
            </tbody>
        </table> --}}
                <div id="modal-dynamic-form">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-update" value="add">Add</button>
            </div>
        </div>
</form>
