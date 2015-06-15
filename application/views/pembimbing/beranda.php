<?php $this->load->view('pembimbing/container_header'); ?>
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
                <li class="active"><a href="<?php echo base_url().'pembimbing/show/beranda' ?>" >Bimbingan</a></li>
                <li><a href="<?php echo base_url().'pembimbing/show/seminar' ?>" >Seminar</a></li>
                <li><a href="<?php echo base_url().'pembimbing/show/dokumen' ?>" >Dokumen Penting</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <h1>Bimbingan Online</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
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
                                Jumlah Bimbingan
                            </th>
                            <th colspan="2">
                                Lihat Bimbingan
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number = 1; foreach($dosbing as $pembimbing){?>
                        <tr>
                            <td><?php echo $number;?></td>
                            <td>
                                KLP<?php echo $pembimbing->ID_KLP;?>
                            </td>
                            <td>
                                <ul>
                                    <?php foreach($dtlmhs as $mahasiswa){
                                        if($mahasiswa->ID_KLP == $pembimbing->ID_KLP){?>
                                    <li><?php echo $mahasiswa->NRP.' '.$mahasiswa->NAMA_MHS;?></li>
                                        <?php } }?>
                                </ul>
                            </td>
                            <td>
                                <?php echo $pembimbing->NAMA_PERUSAHAAN;?>
                            </td>
                            <td>
                                <?php echo $pembimbing->PERIODE;?>
                            </td>
                            <td>
                                <?php foreach($jmlbbg as $jbimbing){
                                    if($jbimbing->ID_KLP == $pembimbing->ID_KLP){
                                        echo $jbimbing->JUMLAH;break;
                                    }
                                }?>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo base_url(); ?>pembimbing/show_bimbingan/KLP<?php echo $pembimbing->ID_KLP;?>">Bimbingan</a>
                            </td>
                        </tr>
                        <?php $number++;}?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

