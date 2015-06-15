    <div class="modal-header">
        <h3 id="myModalLabel">Verifikasi Perusahaan</h3>
    </div>
<form action="<?php echo base_url(); ?>koor/update/perusahaan/<?php echo $idklp;?>" method="post" enctype="multipart/form-data">
    <div class="modal-body">
        <table>
            <tr>
                <td>
                    Kelompok: KLP<?php echo $idklp; ?>
                </td>
            </tr>
            <tr>
                <td>Anggota:<br/>
                    <ul>
                         <?php foreach($dtl as $detail){?>
                        <li><?php echo $detail->NRP.' '.$detail->NAMA_MHS;?></li>
                        <?php }?>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>
                    Tempat KP: <?php echo $klp->NAMA_PERUSAHAAN;?>
                </td>
            </tr>
            <tr>
                <td>
                    Periode KP: <?php echo $klp->PERIODE; ?>
                </td>
            </tr> 
            <tr>
                <td>Dosen Pembimbing : 
                    <select multiple="multiple" name="pembimbing">
                        <?php foreach($dsn as $dosen){?>    
                        <option value="<?php echo $dosen->NIP_DSN;?>" ><?php echo $dosen->NAMA_DSN; ?></option>
                            <?php }?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Catatan:</td>
            </tr>
            <tr>
                <td><textarea style="width: 100%;" name="catatanPerusahaan" placeholder="Catatan Perusahaan"></textarea></td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="Approve" value="<?php echo $idklp;?>">Approve KP</button>
        <button  class="btn btn-danger" name="Reject" value="<?php echo $idklp;?>">Reject KP</button>
    </div>
    </form>