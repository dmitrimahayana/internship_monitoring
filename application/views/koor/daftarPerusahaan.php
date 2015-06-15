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
                <li><a href="<?php echo base_url().'koor/show/praSeminar' ?>" >Pra Seminar</a></li>
                <li><a href="<?php echo base_url().'koor/show/seminar' ?>" >Seminar</a></li>
                <li class="active"><a href="<?php echo base_url().'koor/show/daftarPerusahaan' ?>" >List Perusahaan</a></li>
                <li><a href="<?php echo base_url().'koor/show/nilai' ?>" >Nilai Perusahaan</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <h1>List Perusahaan</h1>
                <a href="#myModalPerusahaan" role="button" class="btn btn-primary" data-toggle="modal">Tambah Perusahaan</a>
                <?php $this->load->view('koor/modalPerusahaan'); ?>
                <form class="navbar-form pull-right" action="<?php echo base_url(); ?>koor/search/perusahaan" method="post">
                    <input type="text" class="search-query" name="cari" placeholder="Cari Berdasarkan Bidang">
                    <button id="submit" class="btn btn-inverse" type="submit">Submit</button>
                </form>
                <?php if($this->session->userdata('cari')){
                    echo $this->session->userdata('cari');
                }
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                Nama
                            </th>
                            <th>
                                Alamat
                            </th>
                            <th>
                                Telp
                            </th>
                            <th>
                                Kode Pos
                            </th>
                            <th>
                                Bidang
                            </th>
                            <th>
                                email
                            </th>
                            <th>
                                Keterangan
                            </th>
                            <th colspan="2">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number = 1; foreach($prsh as $perusahaan){?>
                        <tr>
                            <td><?php echo $number;?></td>
                            <td><?php echo $perusahaan->NAMA_PERUSAHAAN;?></td>
                            <td><?php echo $perusahaan->ALAMAT_PERUSAHAAN;?></td>
                            <td><?php echo $perusahaan->TELP_PERUSAHAAN;?></td>
                            <td><?php echo $perusahaan->KODE_POS;?></td>
                            <td><?php echo $perusahaan->BIDANG;?></td>
                            <td><?php echo $perusahaan->EMAIL;?></td>
                            <td><?php echo ($perusahaan->KETERANGAN)?$perusahaan->KETERANGAN->load():'' ?></td>
                            <td>
                                <button class="btn btn-danger" onclick="showClass('update_perusahaan','<?php echo $perusahaan->ID_PERUSAHAAN?>')">Update Perusahaan</button>
                            </td>
                        </tr>
                        <?php $number++;}?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

