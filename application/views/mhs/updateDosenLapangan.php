 <div class="modal-header">
        <h3 id="myModalLabel">Update Dosen Lapangan</h3>
    </div>
    <div class="modal-body">
        <?php //echo $idklp; ?>
        <form action="<?php echo base_url();?>mhs/update/dosenLapangan" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        Nama Dosen Lapangan
                    </td>
                    <td>
                        <input type="text" name="nama" value="<?php echo $klp->NAMA_DSN_LAPANGAN?>"/>
                    </td>
                </tr>
            </table>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="idklp" value="<?php echo $klp->ID_KLP?>">Save changes</button>
            </div>
          </form>
    </div>