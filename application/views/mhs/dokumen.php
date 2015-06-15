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
                <li class="active"><a href="<?php echo base_url().'mhs/show/dokumen' ?>" >Dokumen Penting</a></li>
                <li><a href="<?php echo base_url().'mhs/show/bimbingan_online' ?>" >Bimbingan</a></li>
                <li><a href="<?php echo base_url().'mhs/show/nilai' ?>" >Nilai</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <h1>Dokumen Penting</h1>
                <table>
                    <tr>
                        <td>
                            <a class="btn btn-primary" href="<?php echo base_url();?>files/TEMPLATE_PROPOSAL.zip" >Download Template Proposal</a><br/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#myModalFinal" role="button" class="btn btn-primary" data-toggle="modal">Upload Project Final/Terbaru</a>
                            <?php $this->load->view('mhs/modal_upload_final_project'); ?>
                        </td>
                        <?php if($this->session->userdata('error')){
                            echo $this->session->userdata('error');
                            $this->session->set_userdata(array('error'=>''));
                        }?>
                    </tr>
                </table>
            </div>
        </div>
        
    </div>

    