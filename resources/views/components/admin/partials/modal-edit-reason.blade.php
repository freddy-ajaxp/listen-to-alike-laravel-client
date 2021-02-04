<form id="form-reason-edit" name="form-platform" class="form-horizontal" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Reason </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id" value="{{$data['id']}}">
                <input type="hidden" id="userErasingImage" value=false>
                <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Reason</label>
                    <div>
                        <input required type="text" class="form-control has-error" id="report_reason" name="report_reason" placeholder="Cth: Hak Cipta" value="{{$data['reason']}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Text</label>
                    <div>
                        <input required type="text"  class="form-control has-error" id='report_text' name="report_text" placeholder="Cth: Konten ini melanggar hak cipta" value="{{$data['text']}}">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-update" value="add">Submit</button>
        </div>

    </div>
</form>
