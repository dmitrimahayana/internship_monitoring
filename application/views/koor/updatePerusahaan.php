 <div class="modal-header">
        <h3 id="myModalLabel">Update Perusahaan</h3>
    </div>
    <div class="modal-body">
        <form action="<?php echo base_url();?>koor/update/daftarPerusahaan/<?php echo $prsh->ID_PERUSAHAAN?>" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        Nama
                    </td>
                    <td>
                        <input type="text" name="nama" value="<?php echo $prsh->NAMA_PERUSAHAAN?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Alamat
                    </td>
                    <td>
                        <input type="text" name="alamat" value="<?php echo $prsh->ALAMAT_PERUSAHAAN?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Telp
                    </td>
                    <td>
                        <input type="text" name="telp" value="<?php echo $prsh->TELP_PERUSAHAAN?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Kode Pos
                    </td>
                    <td>
                        <input type="text" name="kode_pos" value="<?php echo $prsh->KODE_POS?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Bidang
                    </td>
                    <td>
                        <input type="text" name="bidang" value="<?php echo $prsh->BIDANG?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Email
                    </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $prsh->EMAIL?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Keterangan
                    </td>
                    <td>
                        <textarea name="keterangan" value="<?php echo ($prsh->KETERANGAN)?$prsh->KETERANGAN->load():''?>"></textarea>
                    </td>
                </tr>
            </table>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="idprsh" value="<?php echo $prsh->ID_PERUSAHAAN?>">Save changes</button>
            </div>
          </form>
    </div>
  
