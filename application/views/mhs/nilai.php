<?php $this->load->view('mhs/container_header'); ?>

<div class="container">
    <!-- Docs nav
    ================================================== -->
    <div class="row">
        <div class="span12" style="padding-top: 30px;">
            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                <li><a href="<?php echo base_url().'mhs/show/beranda' ?>" >Pengumuman</a></li>
                <li><a href="<?php echo base_url().'mhs/show/upload_proposal' ?>" >Proposal</a></li>
                <li><a href="<?php echo base_url().'mhs/show/dokumen' ?>" >Dokumen Penting</a></li>
                <li><a href="<?php echo base_url().'mhs/show/bimbingan_online' ?>" >Bimbingan</a></li>
                <li class="active"><a href="<?php echo base_url().'mhs/show/nilai' ?>" >Nilai</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <h1>Nilai KLP<?php echo $username?></h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NRP</th>
                            <th>Nama Mhs</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($nmp as $mhs){?>
                        <tr>
                            <td><?php echo $mhs->NRP;?></td>
                            <td><?php echo $mhs->NAMA_MHS;?></td>
                            <td><?php 
                            $nilai = $mhs->NILAI_MHS_PERUSAHAAN;
                            $nilai += isset($nklp->NILAI_AKHIR)?$nklp->NILAI_AKHIR:0;
                            $nilai /=2; echo $nilai; 
                         ?></td>
                         </tr>
                        <?php }?>
                    </tbody>
                </table>
                <?php ?>
            </div>
        </div>
    </div>

