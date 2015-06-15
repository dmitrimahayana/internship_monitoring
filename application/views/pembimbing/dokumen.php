<?php $this->load->view('pembimbing/container_header'); ?>
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
                <li><a href="<?php echo base_url().'pembimbing/show/beranda' ?>" >Bimbingan</a></li>
                <li><a href="<?php echo base_url().'pembimbing/show/seminar' ?>" >Seminar</a></li>
                <li class="active"><a href="<?php echo base_url().'pembimbing/show/dokumen' ?>" >Dokumen Penting</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <h1>Dokumen Penting</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Kelompok</th>
                        <th>Tanggal Upload Project</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number =1; foreach($klp as $kelompok){?>
                        <tr>
                            <td><?php echo $number;?></td>
                            <td>
                                KLP<?php echo $kelompok->ID_KLP;?>
                            </td>
                            <td><?php echo $kelompok->TGL_UPLOAD_PROJECT?></td>
                            <td>
                                <a href="<?php echo ($kelompok->FINAL_UPLOAD_PROJECT)?base_url().'files/project/'.$kelompok->FINAL_UPLOAD_PROJECT:'';?>" role="button" class="btn btn-primary" data-toggle="modal" <?php echo ($kelompok->FINAL_UPLOAD_PROJECT)?'':'disabled'; ?> >Download Project Final/Terbaru</a>
                                <?php //$this->load->view('mhs/modal_upload_final_project'); ?>
                            </td>
                        </tr>
                        <?php $number++;}?>
                        </tbody>
                </table>
            </div>
        </div>
        
    </div>

    