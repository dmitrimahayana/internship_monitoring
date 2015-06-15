<?php $this->load->view('koor/container_header'); ?>
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
                
                $( "#datepicker2" ).datepicker({ 
                    minDate: -1,
                    changeMonth: true,
                    changeYear: true
                });
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
                <li class="active"><a href="<?php echo base_url().'koor/show/seminar' ?>" >Seminar</a></li>
                <li><a href="<?php echo base_url().'koor/show/daftarPerusahaan' ?>" >List Perusahaan</a></li>
                <li><a href="<?php echo base_url().'koor/show/nilai' ?>" >Nilai Perusahaan</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <h1>List Seminar</h1>
                <a href="#myModalSeminar" role="button" class="btn btn-primary" data-toggle="modal">Buat Baru Seminar</a>
                <a href="<?php echo base_url().'koor/show/seminar' ?>" role="button" class="pull-right btn btn-danger" data-toggle="modal">Back to Previous Page</a>
                <?php $data['rng'] = $rng; $data['prd'] = $prd; $data['dsn'] = $dsn; $this->load->view('koor/modalSeminar',$data); ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal/Jam/Ruang</th>
                            <th>Periode</th>
                            <th>Tahun</th>
                            <th>Penguji1</th>
                            <th>Penguji2</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number = 1; $skip=false; foreach($dsnsmr as $seminar){ 
                            if(!$skip){?>
                        <tr>
                            <td><?php echo $number; ?></td>
                            <td><?php $temp =  explode("/", $seminar->TANGGAL); echo $temp[1].' '.date('M', strtotime($temp[0] . '01')).' '.$temp[2].' / '.$seminar->JAM.' / '.$seminar->NAMA_RUANGAN?></td>
                            <td><?php echo $seminar->PERIODE?></td>
                            <td><?php echo $temp[2]?></td>
                            
                            <td><?php echo $seminar->NAMA_DSN; $idDetailSmr=$seminar->ID_DETAIL_SEMINAR;?></td>
                            
                            <?php $skip = true;} else{?>
                            <td><?php echo $seminar->NAMA_DSN;?></td>
                            <td>
                                <button class="btn btn-info" onclick="showClass('seminar', '<?php echo $idDetailSmr.','.$seminar->ID_DETAIL_SEMINAR.','.$seminar->ID_JADWAL;?>')">Update</button>
                            </td>
                            <td>
                                <form action="<?php echo base_url(); ?>koor/delete/listSeminar" method="post" enctype="multipart/form-data">
                                <button class="btn btn-danger" onclick="" name="idjadwal" value="<?php echo $seminar->ID_JADWAL;?>">Delete</button>
                                </form>
                            </td>
                        </tr>
                            <?php $number++; $skip = false;} }?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>