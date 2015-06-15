<?php $this->load->view('koor/container_header'); ?>
<script language="javascript" type="text/javascript">
    function showClass(type, idklp){
        //alert(id_member+" "+type);
        $.ajax({
            type: "POST",
            dataType: "html",
            data: "type="+type+"&idklp="+idklp,
            url: "<?php echo base_url(); ?>koor/validasi",
            success: function(data) {
                //alert('success');
                $('<div>').html(data).dialog({
                    modal: true,
                    width: 'auto',
                    height: 'auto',
                    show: {
                        effect: "fade",
                        duration: 500
                    },
                    hide: {
                        effect: "fade",
                        duration: 500
                    },
                    close: function(event, ui) {$(this).remove();}
                    ,buttons: {
                        'Close': function() {
                           $(this).dialog('close');
                        }
                    }
                }).dialog('open'); 
            }, 
            error: function(xhr,err){
                alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
            }
        });
    }
</script>
<div class="container">
    <!-- Docs nav
    ================================================== -->
    <div class="row">
        
        <div class="span12" style="padding-top: 30px;">
            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                <li><a href="<?php echo base_url().'koor/show/beranda' ?>" >Pra KP</a></li>
                <li class="active"><a href="<?php echo base_url().'koor/show/praSeminar' ?>" >Pra Seminar</a></li>
                <li><a href="<?php echo base_url().'koor/show/seminar' ?>" >Seminar</a></li>
                <li><a href="<?php echo base_url().'koor/show/daftarPerusahaan' ?>" >List Perusahaan</a></li>
                <li><a href="<?php echo base_url().'koor/show/nilai' ?>" >Nilai Perusahaan</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <h1>Pengumuman Lolos Syarat Seminar</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>N0</th>
                            <th>
                                Kelompok
                            </th>
                            <th>
                                Tempat KP
                            </th>
                            <th>
                                Periode
                            </th>
                            <th>
                                Absensi Bimbingan
                            </th>
                            <th>
                                Nilai Perusahaan
                            </th>
                            <th>
                                Final Projet
                            </th>
                            <th colspan="2">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number = 1;foreach($klp as $kelompok){
                            $nilaiTotal = 0;
                            foreach($nmp as $nilai){
                                if($nilai->ID_KLP == $kelompok->ID_KLP){
                                    $nilaiTotal += $nilai->NILAI_MHS_PERUSAHAAN;
                                }
                            }
                        ?>
                        <tr>
                            <td><?php echo $number?></td>
                            <td>
                                KLP<?php echo $kelompok->ID_KLP?>
                            </td>
                            <td>
                                <?php echo $kelompok->NAMA_PERUSAHAAN;?>
                            </td>
                            <td>
                                <?php echo $kelompok->PERIODE;?>
                            </td>
                            <td>
                                <?php echo ($kelompok->JUMLAH>=1)?'SUDAH':'BELUM'; echo ' MEMENUHI'?>
                            </td>
                            <td>
                                <?php echo ($nilaiTotal>0)?'SUDAH':'BELUM'; echo ' MENGUMPULKAN' ?>
                            </td>
                            <td>
                                <?PHP echo ($kelompok->FP)?'SUDAH':'BELUM'; echo ' MENGUMPULKAN' ?>
                            </td>
                            <td>
                                <button
                                    <?php if(!$kelompok->JUMLAH  or !$kelompok->FP or !$nilaiTotal or ($kelompok->JUMLAH>=1 and $nilaiTotal>0 and $kelompok->FP and in_array($kelompok->ID_KLP,$verifikasi)) ){
                                        echo 'disabled '; echo 'class="btn btn-danger"';}
                                        else{ echo 'class="btn btn-primary"';}
                                    ?>
                                      type="button" onclick="location.href='<?php echo base_url();?>koor/update/praSeminar/<?php echo $kelompok->ID_KLP;?>'">
                                    <?php echo ($kelompok->JUMLAH>=1 and $nilaiTotal>0 and $kelompok->FP and in_array($kelompok->ID_KLP,$verifikasi) )?'Sudah Terverifikasi':'Verifikasi Pra Seminar'; ?>
                                </button>
                            </td>
                        </tr>
                        <?php $number++;}?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>