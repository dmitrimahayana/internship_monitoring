<?php $this->load->view('mhs/container_header'); ?>
<script>
    $(function() {
        $( "#accordion" ).accordion({
             heightStyle: "content"
        });
    });
</script>
<div class="container">
    <!-- Docs nav
    ================================================== -->
    <div class="row">
        
        <div class="span12" style="padding-top: 30px;">
            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                <li><a href="<?php echo base_url().'mhs/show/beranda' ?>" >Pengumuman</a></li>
                <li><a href="<?php echo base_url().'mhs/show/upload_proposal' ?>" >Proposal</a></li>
                <li><a href="<?php echo base_url().'mhs/show/dokumen' ?>" >Dokumen Penting</a></li>
                <li class="active"><a href="<?php echo base_url().'mhs/show/bimbingan_online' ?>" >Bimbingan</a></li>
                <li><a href="<?php echo base_url().'mhs/show/nilai' ?>" >Nilai</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <h1>Bimbingan Online</h1>
                     <?php $this->load->view('mhs/modalBimbingan'); ?>
                <table style="width: 80%;">
                    <tr><td><a href="#myModalBimbingan" role="button" class="btn btn-primary" data-toggle="modal">Buat Baru Bimbingan</a></td></tr>
                    <tr>
                        <td>
                            <div id="accordion">
                                <?php $dateNow = str_replace("-","/",date("m-d-Y")); foreach($bbg as $bimbingan){?>
                                <h3>Bimbingan tanggal <?php $tggl = explode("/", $bimbingan->TANGGAL_BIMBINGAN); echo $tggl[1].' '.date('M', strtotime($tggl[0] . '01')).' '.$tggl[2]?></h3>
                                <div>
                                    <?php foreach($cttn as $catatan){
                                        if($catatan->ID_BIMBINGAN == $bimbingan->ID_BIMBINGAN){?>
                                    <p><?php echo $catatan->USER;?></p>
                                    <p><?php //echo $catatan->TEXT_CATATAN->load();
                                    echo $catatan->TEXT_CATATAN; ?></p>
                                    <hr>
                                    <?php }}
                                    //if($dateNow==$bimbingan->TANGGAL_BIMBINGAN){ ?>
                                    <form action="<?php echo base_url();?>mhs/insert/catatanBimbingan" method="post" enctype="multipart/form-data">
                                    <p><textarea placeholder="Comment" style="width: 100%;" name="catatan"></textarea></p>
                                    <button type="submit" class="btn btn-primary" name="idBimbingan" value="<?php echo $bimbingan->ID_BIMBINGAN?>">Save changes</button>
                                    </form>
                                    <?php //}?>
                                </div>
                                <?php }?>
                            </div>
                        </td>
                    </tr>
                </table>
               
            </div>
        </div>
        
    </div>

    