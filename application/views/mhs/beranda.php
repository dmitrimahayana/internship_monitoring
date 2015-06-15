<?php $this->load->view('mhs/container_header'); ?>

<script language="javascript" type="text/javascript">
    function showClass(type, idklp){
        //alert(id_member+" "+type);
        $.ajax({
            type: "POST",
            dataType: "html",
            data: "type="+type+"&idklp="+idklp,
            url: "<?php echo base_url(); ?>mhs/validasi",
            success: function(data) {
                //alert('success');
                $('<div>').html(data).dialog({
                    modal: true,
                    width: '400',
                    height: '400',
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
                alert("ERROR\nreadyState: "+xhr.readyState+"\nstatus: "+xhr.status);
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
                <li class="active"><a href="<?php echo base_url().'mhs/show/beranda' ?>" >Pengumuman</a></li>
                <li><a href="<?php echo base_url().'mhs/show/upload_proposal' ?>" >Proposal</a></li>
                <li><a href="<?php echo base_url().'mhs/show/dokumen' ?>" >Dokumen Penting</a></li>
                <li><a href="<?php echo base_url().'mhs/show/bimbingan_online' ?>" >Bimbingan</a></li>
                <li><a href="<?php echo base_url().'mhs/show/nilai' ?>" >Nilai</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <h1>Pengumuman</h1>
                <?php if( isset($klp->NAMA_PERUSAHAAN) and isset($klp->PERIODE) and isset($klp->NAMA_DSN)){
                    echo '<br/>';
                    echo (isset($klp->SETUJU_PERUSAHAAN))?'<h3>Proposal Perusahaan '.(($klp->SETUJU_PERUSAHAAN=='Approve')?'Diterima':'Ditolak').'</h3>':''; 
                    //echo (isset($klp->CATATAN_PERUSAHAAN))?'<p>Catatan Perusahaan : '.$klp->CATATAN_PERUSAHAAN->load().'</p>':'';
                    echo (isset($klp->CATATAN_PERUSAHAAN))?'<p>Catatan Perusahaan : '.$klp->CATATAN_PERUSAHAAN.'</p>':'';
                    ?>
                <table class="table table-striped">
                   <thead>
                        <tr>
                            <th>Nama Perusahaan</th>
                            <th>Periode</th>
                            <th>Dosen Pembimbing</th>
                            <th>Pembimbing Lapangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $klp->NAMA_PERUSAHAAN?></td>
                            <td><?php echo $klp->PERIODE;?></td>
                            <td><?php echo $klp->NAMA_DSN?></td>
                            <td><?php echo $klp->NAMA_DSN_LAPANGAN?></td>
                            <td>
                                <button class="btn btn-danger" onclick="showClass('dosenLapangan','<?php echo $klp->ID_KLP?>')">Update Pembimbing Lapangan</button>
                            </td>
                        </tr>
                    </tbody>
                     </table>
                <?php } if($jwl!=''){?>
                <h3>Jadwal Seminar</h3>
                <table class="table table-striped">
                   <thead>
                        <tr>
                            <th>Tanggal/Jam/Ruang</th>
                            <th>Periode</th>
                            <th>Catatan Dosen Pembimbing</th>
                            <th>Catatan Penguji1</th>
                            <th>Catatan Penguji2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php $temp =  explode("/", $jwl->TANGGAL); echo $temp[1].' '.date('M', strtotime($temp[0] . '01')).' '.$temp[2].' / '.$jwl->JAM.' / '.$jwl->NAMA_RUANGAN?></td>
                            <td><?php echo $jwl->PERIODE;?></td>
                            <td><?php //echo isset($nklp->CATATAN_DOSBING)?$nklp->CATATAN_DOSBING->load():'';
                            echo isset($nklp->CATATAN_DOSBING)?$nklp->CATATAN_DOSBING:''?></td>
                            <td><?php //echo isset($nklp->CATATAN_PENGUJI1)?$nklp->CATATAN_PENGUJI1->load():'';
                            echo isset($nklp->CATATAN_PENGUJI1)?$nklp->CATATAN_PENGUJI1:'';?></td>
                            <td><?php //echo isset($nklp->CATATAN_PENGUJI2)?$nklp->CATATAN_PENGUJI2->load():'';
                            echo isset($nklp->CATATAN_PENGUJI2)?$nklp->CATATAN_PENGUJI2:'';?></td>
                        </tr>
                    </tbody>
                     </table>
                    <?php } 
                    if(!isset($klp->SETUJU_PERUSAHAAN) and isset($klp->SETUJU_DOSEN)){
                        echo '<br/>';
                        echo (isset($klp->SETUJU_DOSEN))?'<h3>Proposal KP '.(($klp->SETUJU_DOSEN=='Approve')?'Diterima':'Ditolak').'</h3>':''; 
                        echo (isset($klp->CATATAN_PROPOSAL))?'<p>Catatan Dosen : '.$klp->CATATAN_PROPOSAL->load().'</p>':'';
                    }
                        ?>
            </div>
        </div>
    </div>

