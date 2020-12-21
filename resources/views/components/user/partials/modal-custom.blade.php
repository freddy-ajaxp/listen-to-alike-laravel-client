<!-- modal Custom -->
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
<!-- modal Custom end -->
