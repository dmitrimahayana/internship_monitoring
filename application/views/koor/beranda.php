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
                <li class="active"><a href="<?php echo base_url().'koor/show/beranda' ?>" >Pra KP</a></li>
                <li><a href="<?php echo base_url().'koor/show/praSeminar' ?>" >Pra Seminar</a></li>
                <li><a href="<?php echo base_url().'koor/show/seminar' ?>" >Seminar</a></li>
                <li><a href="<?php echo base_url().'koor/show/daftarPerusahaan' ?>" >List Perusahaan</a></li>
                <li><a href="<?php echo base_url().'koor/show/nilai' ?>" >Nilai Perusahaan</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <h1>Pengumuman Proposal KP</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>N0</th>
                            <th>
                                Kelompok
                            </th>
                            <th>
                                Anggota
                            </th>
                            <th>
                                Tempat KP
                            </th>
                            <th>
                                Periode
                            </th>
                            <th>
                                Proposal
                            </th>
                            <th colspan="2">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number = 1;foreach($klp as $kelompok){?>
                        <tr>
                            <td><?php echo $number?></td>
                            <td>
                                KLP<?php echo $kelompok->ID_KLP?>
                            </td>
                            <td>
                                <ul>
                                    <?php foreach($dtl as $detail){
                                        if($kelompok->ID_KLP == $detail->ID_KLP){?>
                                    <li><?php echo $detail->NRP.' '.$detail->NAMA_MHS?></li>
                                        <?php }}?>
                                </ul>
                            </td>
                            <td>
                                <?php echo $kelompok->NAMA_PERUSAHAAN;?>
                            </td>
                            <td>
                                <?php echo $kelompok->PERIODE;?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info" onclick="location.href='<?php echo base_url().'files/proposal/'.$kelompok->PROPOSAL_KP;?>'">Download Proposal</button>
                            </td>
                            <td>
                                <?php //echo 'dosen:'.$kelompok->SETUJU_DOSEN.' perusahaan:'.$kelompok->SETUJU_PERUSAHAAN; ?>
                                <button <?php if($kelompok->SETUJU_DOSEN=="Approve"){echo 'disabled';}?> class="btn btn-primary" onclick="showClass('proposal', '<?php echo $kelompok->ID_KLP?>')">Verifikasi Proposal</button>
                            </td>
                            <td>
                                <button <?php 
                                if($kelompok->SETUJU_DOSEN=="Approve" and $kelompok->SETUJU_PERUSAHAAN!="Approve"){echo "";}
                                else {echo 'disabled';}
                                ?> class="btn btn-danger" onclick="showClass('perusahaan', '<?php echo $kelompok->ID_KLP?>')">Verifikasi Perusahaan</button>
                            </td>
                        </tr>
                        <?php $number++;}?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

