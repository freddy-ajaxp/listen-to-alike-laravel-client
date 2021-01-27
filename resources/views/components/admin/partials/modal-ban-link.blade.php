    <form id="form-ban-link" name="form-ban-link" class="form-horizontal" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Ban Link </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Halaman Link yang di Ban/larang tidak dapat dilihat oleh pengguna sampai dipulihkan kembali<p name="confirm-delete-name"> </p>
                    <input type="hidden" id="id_ban_link" value={{$idReport}} />
                <div class="form-group">
                    <label for="banReason">Alasan Ban</label>
                    <textarea required class="form-control" id="banReason" rows="3" style="resize: vertical;">Link anda dengan kode "{{$dataLink->short_link}}"" dan judul "{{$dataLink->title}}"" terpaksa kami lakukan blokir karena:</textarea>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Lanjutkan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                </div>
            </div>
        </div>
    </form>