<?php $this->load->view('pembimbing/container_header'); ?>
<script>
    $(function() {
        $( "#datepicker" ).datepicker({ 
            minDate: -1,
            changeMonth: true,
            changeYear: true
            /*maxDate: "+1M +10D" */
        });
    });
</script>
<script language="javascript" type="text/javascript">
    function showClass(type, idklp){
        //alert(id_member+" "+type);
        $.ajax({
            type: "POST",
            dataType: "html",
            data: "type="+type+"&idklp="+idklp,
            url: "<?php echo base_url(); ?>pembimbing/validasi",
            success: function(data) {
                //alert('success');
                $('<div>').html(data).dialog({
                    modal: true,
                    width: '50%',
                    height: 'auto',
                    show: {
                        effect: "fade",
                        duration: 500
                    },
                    hide: {
                        effect: "fade",
                        duration: 500
                    },
                    open: function(event, ui) {
                        $(ui).find('#datepicker').datepicker().click(function(){
                            $(this).datepicker('show');
                        });
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
                <li><a href="<?php echo base_url().'pembimbing/show/beranda' ?>" >Bimbingan</a></li>
                <li class="active"><a href="<?php echo base_url().'pembimbing/show/seminar' ?>" >Seminar</a></li>
                <li><a href="<?php echo base_url().'pembimbing/show/dokumen' ?>" >Dokumen Penting</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <h1>Jadwal Seminar</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal/Jam/Ruang</th>
                            <th>NRP Nama_Mhs</th>
                            <th>Periode</th>
                            <th>Tahun</th>
                            <th>Tempat KP</th>
                            <th>Nilai</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $number = 1; foreach($smr as $seminar){
                            $mhs = array();
                             foreach($dtlmhs as $mahasiswa){
                                    if($mahasiswa->ID_KLP == $seminar->ID_KLP){
                                        array_push($mhs,$mahasiswa);
                                    }
                             }?>
                        <tr>
                            <td><?php echo $number;?></td>
                            <td><?php $temp =  explode("/", $seminar->TANGGAL); echo $temp[1].' '.date('M', strtotime($temp[0] . '01')).' '.$temp[2].' / '.$seminar->JAM.' / '.$seminar->NAMA_RUANGAN?></td>
                            <td>
                                <ul>
                                    <?php for($i=0;$i<count($mhs);$i++){?>
                                    <li><?php echo $mhs[$i]->NRP.' '.$mhs[$i]->NAMA_MHS;?></li>
                                        <?php }?>
                                </ul>
                            </td>
                            <td><?php echo $seminar->PERIODE?></td>
                            <td><?php echo $temp[2]; ?></td>
                            <td><?php echo $mhs[0]->NAMA_PERUSAHAAN?></td>
                            <td><?php echo $seminar->NILAI_AKHIR_PEMBIMBING;?></td>
                            <td>
                                <button class="btn btn-info" onclick="showClass('nilai', '<?php echo $seminar->ID_KLP?>')">Update Nilai</button>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>