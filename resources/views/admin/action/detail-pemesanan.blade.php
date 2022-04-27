<div class="row">
    <div class="col-6">
        <table>
            <tr>
                <td style="width: 150px">Nama Pemesan</td>
                <td style="width: 16px">:</td>
                <td style="text-transform: capitalize">{{ $data->nama_pemesan }}</</td>
            </tr>
            <tr>
                <td style="width: 150px">No Hp</td>
                <td style="width: 16px">:</td>
                <td>{{ $data->no_hp }}</</td>
            </tr>
            <tr>
                <td style="width: 150px">Email</td>
                <td style="width: 16px">:</td>
                <td>{{ $data->email }}</</td>
            </tr>
            <tr>
                <td style="width: 150px">Waktu Pesan</td>
                <td style="width: 16px">:</td>
                <td>{{ date('l, d-M-Y, H:i:s a', strtotime($data->tanggal_dipesan)) }}</</td>
            </tr>
        </table>
    </div>
    <div class="col-6">
        <table>
            <tr>
                <td style="width: 150px">Nama Tamu</td>
                <td style="width: 16px">:</td>
                <td style="text-transform: capitalize">{{ $data->nama_tamu }}</</td>
            </tr>

            <tr>
                <td style="width: 150px">Status</td>
                <td style="width: 16px">:</td>
                <td style="text-transform: capitalize">{{ $data->status_pemesan }}</</td>
            </tr>

            <tr>
                <td style="width: 150px">Update Status</td>
                <td style="width: 16px">:</td>
                <td style="width: 150px">
                    <form name="update_pemesanan" id="update-form" action="{{ route('manage-pemesanan.store') }}" method="post">
                        @method('patch')
                        @csrf
                        <input type="hidden" value="{{ $data->id }}" name="id" id="id_data"/>
                        <select name="status" class="form-control form-control-sm">
                            @if ($data->status_pemesan == 'pending')
                            <option value="cancel">Cancel</option>
                            <option value="checkin" selected> Check IN</option>
                            @endif
                            @if ($data->status_pemesan == 'checkin')
                            <option value="checkout"> Check OUT</option>
                            @endif
                        </select>
                    </form>
                 </td>
                 <td> <button type="button" id="btn-update-status" class="btn btn-sm btn-success ml-2">Update</button> </td>
            </tr>
        </table>
    </div>
    <div class="col-12 mt-3">
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Deskripsi</th>
                  <th>Jumlah</th>
                  <th>Harga satuan</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Kamar {{ $data->kamar->nama_kamar }}</td>
                  <td>{{ $data->jumlah_kamar_dipesan }} Kamar</td>
                  <td>Rp. {{ number_format($data->kamar->harga, 2, ',', '.') }}</td>
                  <td>Rp. {{ number_format($data->kamar->harga*$data->jumlah_kamar_dipesan, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Durasi inap</td>
                    <td>
                        <?php
                        $date1=date_create($data->tanggal_checkin);
                        $date2=date_create($data->tanggal_checkout);
                        $diff=date_diff($date1,$date2);
                        echo $diff->format("%a Malam");
                        ?>
                    </td>
                    <td> - </td>
                    <td> - </td>
                </tr>
                <tr>
                  <td>Total bayar</td>
                  <td> - </td>
                  <td> - </td>
                  <td>Rp. {{ number_format($data->kamar->harga*$data->jumlah_kamar_dipesan*$diff->format("%a"), 2, ',', '.') }}</td>
                </tr>
                <tr>
              </tbody>
            </table>
          </div>
    </div>
</div>

<script>
    $('#btn-update-status').on('click', function() {
            let id = $("#update-form").find("#id_data").val()
            let update_status = $('#update-form').serialize()
            $.ajax({
                url : `/admin/manage-pemesanan/update-status/${id}`,
                type : 'post',
                method : "patch",
                data : update_status,
                success : function(data) {
                $("#detailModal").modal('hide');
                alert("Status berhasil di ubah");
                window.location.assign('/admin/manage-pemesanan');
                },
                error : function(error) {
                    console.log(error.responseJSON);
                    let err_log = error.responseJSON.errors;
                }
            })
        });
</script>
