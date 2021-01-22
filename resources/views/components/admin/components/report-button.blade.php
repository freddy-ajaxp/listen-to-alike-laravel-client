<div style="text-align: right;position: fixed;z-index:9999;bottom: 0;width: auto;right: 1%;cursor: pointer;line-height: 3;display:block !important;">
    <a title="Report Link" target="_blank" href="" data-toggle="modal" data-target="#modals">

        <img style="max-height: 20px;" src="{{asset('images/icons/warning.png')}}" alt="report">
        report
        {{-- <img src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png" alt="www.000webhost.com"> --}}
    </a>
</div>

<div class="modal fade" id="modals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:9999">
    <form id="form-report">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Report This Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label for="message-text" class="col-form-label">Please tell us the reason:</label>

    {{-- @foreach($reasons as $key => $reason)
				@foreach($reason->reports as $h)
                {{$h->additional_reason }}
				@endforeach
	@endforeach --}}






                    @foreach($reasons as $key => $reason)
                    <div class="form-group">
                        <div class="form-check">
                            <input name="reasons[]" class="form-check-input" type="checkbox" value="{{$reason->text}}" data-id="{{$reason->id}}" id="reason-{{$reason->id}}">
                            <label class="form-check-label" for="reason-{{$reason->id}}">
                                {{$reason->text}}
                            </label>
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group">
                        <div class="form-check">
                            <label for="message-text" class="col-form-label">More:</label>
                            <textarea class="form-control" id="reason" style="resize: none; color: inherit;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
