<?php $this->load->view('mhs/container_header'); ?>
<script>
    $(function() {
        $( "#accordion" ).accordion({
            heightStyle: "content",
            active: false,
            collapsible: true   
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
                <li class="active"><a href="<?php echo base_url().'mhs/show/upload_proposal' ?>" >Proposal</a></li>
                <li><a href="<?php echo base_url().'mhs/show/dokumen';?>" >Dokumen Penting</a></li>
                <li><a href="<?php echo base_url().'mhs/show/bimbingan_online' ?>" >Bimbingan</a></li>
                <li><a href="<?php echo base_url().'mhs/show/nilai' ?>" >Nilai</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <table>
                    <tr>
                        <td>Kelompok</td>
                        <td> : </td>
                        <td>KLP<?php echo $username;?></td>
                    </tr>
                    <tr>
                        <td>Tempat KP</td>
                        <td> : </td>
                        <td><?php echo (isset($klp->NAMA_PERUSAHAAN))?$klp->NAMA_PERUSAHAAN:null; ?></td>
                    </tr>
                    <tr>
                        <td>Periode</td>
                        <td> : </td>
                        <td><?php echo $klp->PERIODE?></td>
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td> : </td>
                        <td>2013</td>
                    </tr>
                    <tr>
                        <td>Proposal</td>
                        <td> : </td>
                        <td><?php echo (isset($klp->PROPOSAL_KP))?$klp->PROPOSAL_KP:'';?></td>
                    </tr>
                </table>
                <br/>
                <div id="accordion">
                    <h3>Upload Proposal</h3>
                    <div>
                        <h1>Upload Proposal</h1>
                        <form action="<?php echo base_url();?>mhs/update/kp" method="post" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td>
                                        <label style="vertical-align:text-top;">Nama Perusahaan</label>
                                    </td>
                                    <td>
                                        <select id="perusahaan" name="perusahaan" multiple="multiple" onchange="javascript:showType(this.value)">
                                            <?php foreach($prs as $perusahaan) {?>
                                            <option value="<?php echo $perusahaan->ID_PERUSAHAAN.'+'.$perusahaan->NAMA_PERUSAHAAN?>"><?php echo $perusahaan->NAMA_PERUSAHAAN?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="input-block-level" id="namePerusahaan" name="namePerusahaan" readonly="true"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Upload Form
                                    </td>
                                    <td>
                                        <input class="input-block-level" type="file" name="proposal_KP" />
                                    </td>
                                </tr>
                            </table>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="idklp" value="<?php echo $username;?>">Save changes</button>
                            <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
     function showType(showhide){
        //var inp = $('#perusahaan').val();
        var data = showhide.split('+');
        var inp = data[1];
        //var data = temp.split("+");
        //var inp = temp[0];
        //alert())
        $("#namePerusahaan").val(inp);
     }
</script>