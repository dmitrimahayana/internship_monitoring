   <div class="modal-header">
        <h3 id="myModalLabel">Verifikasi Proposal</h3>
    </div>
<form action="<?php echo base_url(); ?>koor/update/proposal/<?php echo $idklp;?>" method="post" enctype="multipart/form-data">      
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
                <td>Catatan:</td>
            </tr>
            <tr>
                <td><textarea style="width: 100%;"  name="catatanProposal" placeholder="Catatan Proposal"></textarea></td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="Approve" value="<?php echo $idklp;?>">Approve Proposal</button>
        <button  class="btn btn-danger" name="Reject" value="<?php echo $idklp;?>">Reject Proposal</button>
    </div>
    </form>