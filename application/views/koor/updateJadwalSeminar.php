<div class="modal-header">
        <h3 id="myModalLabel">Pembuatan Seminar</h3>
    </div>
    <div class="modal-body">
        <form action="<?php echo base_url(); ?>koor/update/listSeminar/<?php echo $jwl->ID_JADWAL;?>" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        Periode KP
                    </td>
                    <td>
                        <select name="periode">
                            <?php foreach($prd as $periode){
                                if($periode->ID_PERIODE == $jwl->ID_PERIODE) {?>
                            <option selected="selected" value="<?php echo $periode->ID_PERIODE?>"><?php echo $periode->PERIODE?></option>
                                <?php }else {?>
                            <option value="<?php echo $periode->ID_PERIODE?>"><?php echo $periode->PERIODE?></option>
                                <?php } }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Ruangan
                    </td>
                    <td>
                        <select multiple="multiple" name="ruangan">
                            <?php foreach($rng as $ruangan){ 
                                if($ruangan->ID_RUANG == $jwl->ID_RUANG){?>
                            <option selected="selected" value="<?php echo $ruangan->ID_RUANG;?>"><?php echo $ruangan->NAMA_RUANGAN;?></option>
                                <?php }else{?>
                            <option value="<?php echo $ruangan->ID_RUANG;?>"><?php echo $ruangan->NAMA_RUANGAN;?></option>
                                <?php } }?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Tanggal
                    </td>
                    <td>
                        <input type="text" id="datepicker2" name="tanggal" value="<?php echo $jwl->TANGGAL;?>"/>
                    </td>
                </tr>
                <tr>
                    <?php $temp = explode('.', $jwl->JAM);?>
                    <td>Jam :</td>
                    <td><select class="span1" name="jam">
                            <?php for($i='6'; $i<='21' ;$i++){
                                if($temp[0] == $i){?>
                                 <option selected="selected" ><?php echo ($i < '10') ? '0'.$i : $i;?></option>
                                <?php } else {?>
                                <option><?php echo $i < '10' ? '0'.$i : $i;?></option>
                            <?php }}?>
                        </select>
                        Menit : <select class="span1" name="menit">
                            <?php for($i='0'; $i<='55' ;$i+='5'){
                                if($temp[1] == $i){?>
                                 <option selected="selected"><?php echo ($i < '10') ? '0'.$i : $i;?></option>
                                <?php } else {?>
                                <option><?php echo $i < '10' ? '0'.$i : $i;?></option>
                            <?php }}?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Dosen Penguji 1
                    </td>
                    <td>
                        <select name="Penguji1">
                            <?php foreach($dsn as $dosen){
                                if($dosen->PEMBIMBING == 0){?>
                            <option <?php echo ($penguji1->NIP_DSN==$dosen->NIP_DSN)?'selected="selected"':''; ?> value="<?php echo $dosen->NIP_DSN; ?>"><?php echo $dosen->NAMA_DSN?></option>
                                <?php }}?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Dosen Penguji 2
                    </td>
                    <td>
                         <select name="Penguji2">
                            <?php foreach($dsn as $dosen){
                                if($dosen->PEMBIMBING == 0){?>
                             <option <?php echo ($penguji2->NIP_DSN==$dosen->NIP_DSN)?'selected="selected"':'';?> value="<?php echo $dosen->NIP_DSN; ?>"><?php echo $dosen->NAMA_DSN?></option>
                                <?php }}?>
                        </select>
                    </td>
                </tr>
            </table>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="idjadwal" value="<?php echo $idsmr.','.$jwl->ID_JADWAL;?>">Save changes</button>
        </div>
    </form> 
    </div>
    