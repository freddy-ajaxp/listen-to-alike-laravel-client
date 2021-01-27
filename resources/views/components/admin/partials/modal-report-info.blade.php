    <form id="form-report-info" name="form-ban-link" class="form-horizontal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Laporan/Aduan </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div style="max-height: 500px; overflow-y: auto;">
                    <table class="table table-striped projects" >
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Jenis Laporan
                                </th>
                                <th>
                                    Jumlah
                                </th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach($reportsInfo as $key => $report)
                            <tr>
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>
                                    {{$report['reason']}}
                                </td>
                                <td>
                                    {{$report['jumlah']}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>    
                    </div>
                    <div class="table-responsive ">
                        <table id="example2" class="table table-bordered table-striped table-hover users-table ">
                            <thead>
                                <tr>
                                    <th>Catatan Pengunjung</th>
                                </tr>
                            </thead>
                            <tbody style="height: 10px; overflow-y: scroll"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
