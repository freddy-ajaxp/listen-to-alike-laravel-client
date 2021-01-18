<!-- modal Custom -->
    <form id="form-custom" name="form-custom" class="form-horizontal" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customize URL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>URL Link:</p>
                    <input type="hidden" id="id_custom" />
                    <div class="col-auto">
                        <div class="input-group mb-2" for="custom-link">
                            <div class="input-group-prepend">
                                <div class="input-group-text">{{config('constants.site_url')}}</div>
                            </div>
                            <input type="text" name="custom-link" class="form-control" placeholder="URL dari platform" value="${eachData.url_platform}" />
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
<!-- modal Custom end -->
