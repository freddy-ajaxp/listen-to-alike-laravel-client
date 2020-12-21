<!-- modal add -->
{{-- <div class="modal bd-example-modal-lg" id="modal-add-link" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="form-add-link" name="form-add-link" class="form-horizontal" novalidate="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create New Link</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-3 control-label">Title</label>
                        <div>
                            <input type="text" class="form-control has-error" id="link_title_add" name="link_title" placeholder="title" value="">
                        </div>
                    </div>




                    <div class='music-link__platform__input'>
                        <div>
                            <label>
                                <input class="music-link__youtube-embed-checkbox" type="checkbox" id="checkbox" style='margin-right:1em;width:auto'>Embed YouTube Video
                            </label>
                        </div>
                        <div class="music-link__youtube-embed ">
                            <input disabled type="text" name="video_embed_url" id="video_embed_url_add" class="music-link__youtube" placeholder='E.g. youtube.com/watch?v=dQw4w9WgXcQ'>

                            <div class="music-link__youtube-card">
                                <img class="music-link__youtube-thumbnail" height="75" width="110">
                                <div>
                                    <p class="music-link__youtube-title"></p>
                                    <small class="music-link__youtube-description"></small>
                                </div>
                            </div>
                        </div>
                    </div>





                    {{-- <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Video URL</label>
                        <div>
                            <input type="text" class="form-control" id="video_embed_url_add" name="video_embed_url" placeholder="Video URL" value="">
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <div class="col-md-12 mb-2">
                        </div>
                        <label for="inputDetail" class="col-sm-3 control-label">Image</label>
                        <div class="music-link__upload-art">
                            <b style=" font-weight: 500; margin-bottom: '0.5em'">
                                Upload Image
                            </b>
                            <p style="font-size: '0.8em'; opacity: '0.8' ">
                                jpg | jpeg | png <br> Max 10MB <br> Drop file here.
                            </p>
                            <img id="image-preview-container-add" src="" style="max-height: 150px;">
                            <input id="image-add" class="music-link__upload-input" type="file" name="image" accept="image/*" />
                        </div>
                        <button id="clear-image-add" hidden> clear</button>
                    </div>
                    <div>
                        <button type="button" id="add-link-platform" class="btn btn-info btn-sm">Add New Row</button>
                        <hr>
                    </div>
                    <div id="modal-dynamic-form-add">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-submit" value="add-new">Create</button>
                </div>
    </form>
</div>
</div>
</div> --}}
<!-- modal add end -->

<!-- modalfof edit -->
{{-- <div class="modal bd-example-modal-lg" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="form-platform" name="form-platform" class="form-horizontal" novalidate="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Form Link</h4>
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
                    <div id="modal-dynamic-form">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-update" value="add">Update</button>
                </div>
    </form>
</div>
</div>
</div> --}}
<!-- modal edit end -->


<!-- modal delete -->
{{-- <div class="modal" id="modal-delete" role="dialog">
    <form id="form-delete" name="form-delete" class="form-horizontal" novalidate="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>konfirmasi hapus data:</p>
                    <input type="hidden" id="id_delete" />
                    <p name="confirm-delete-name"> </p>
                    <p>Lanjutkan?</p>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div> --}}
<!-- modal delete end -->

<!-- modal Custom -->
    {{-- <div class="modal" id="modal-custom" role="dialog">
        <form id="form-custom" name="form-custom" class="form-horizontal" novalidate="">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Customize URL</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Data Link:</p>
                        <input type="hidden" id="id_custom" />
                        <div class="col-auto">
                            <label class="sr-only" for="inlineFormInputGroup">Username</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">link.pendek/</div>
                                </div>
                                <input type="text" name="custom-link" class="form-control form-control-sm" placeholder="URL dari platform" value="${eachData.url_platform}" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn-custom" class="btn btn-success">Custom</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div> --}}
<!-- modal Custom end -->
