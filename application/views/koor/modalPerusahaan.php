<div id="myModalPerusahaan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-header">
        <h3 id="myModalLabel">Perusahaan</h3>
    </div>
    <div class="modal-body">
        <form action="<?php echo base_url();?>koor/insert/daftarPerusahaan" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        Nama
                    </td>
                    <td>
                        <input type="text" name="nama" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Alamat
                    </td>
                    <td>
                        <input type="text" name="alamat" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Telp
                    </td>
                    <td>
                        <input type="text" name="telp" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Kode Pos
                    </td>
                    <td>
                        <input type="text" name="kode_pos" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Bidang
                    </td>
                    <td>
                        <input type="text" name="bidang" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Email
                    </td>
                    <td>
                        <input type="text" name="email" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Keterangan
                    </td>
                    <td>
                        <textarea name="keterangan" ></textarea>
                    </td>
                </tr>
            </table>
        
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button  type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </form>
</div>