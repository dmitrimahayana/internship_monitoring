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
                <li><a href="<?php echo base_url().'koor/show/beranda' ?>" >Pra KP</a></li>
                <li><a href="<?php echo base_url().'koor/show/praSeminar' ?>" >Pra Seminar</a></li>
                <li class="active"><a href="<?php echo base_url().'koor/show/seminar' ?>" >Seminar</a></li>
                <li><a href="<?php echo base_url().'koor/show/daftarPerusahaan' ?>" >List Perusahaan</a></li>
                <li><a href="<?php echo base_url().'koor/show/nilai' ?>" >Nilai Perusahaan</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <h1>Jadwal Seminar</h1>
                <a href="<?php echo base_url().'koor/show/listSeminar' ?>" role="button" class="btn btn-primary" data-toggle="modal">List Seminar</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal/Jam/Ruang</th>
                            <th>Kelompok</th>
                            <th>NRP Nama_Mhs</th>
                            <th>Periode</th>
                            <th>Tempat KP</th>
                            <th>Pembimbing</th>
                            <th>Penguji1</th>
                            <th>Penguji2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number=1; $skip = false; foreach($dsnsmr as $seminar){
                            if($seminar->ID_KLP=='')break;
                            if(!$skip){?>
                        <tr>
                            <td><?php echo $number; ?></td>
                            <td><?php $temp =  explode("/", $seminar->TANGGAL); echo $temp[1].' '.date('M', strtotime($temp[0] . '01')).' '.$temp[2].' / '.$seminar->JAM.' / '.$seminar->NAMA_RUANGAN?></td>
                            <td>KLP<?php echo $seminar->ID_KLP;?></td>
                            <td>
                                <ul>
                                    <?php foreach($dtlmhs as $mahasiswa){
                                        if($mahasiswa->ID_KLP == $seminar->ID_KLP){?>
                                    <li><?php echo $mahasiswa->NRP.' '.$mahasiswa->NAMA_MHS;?></li>
                                        <?php }}?>
                                </ul>
                            </td>
                            <td><?php echo $seminar->PERIODE?></td>
                            <?php foreach($dtlmhs as $mahasiswa){
                                if($mahasiswa->ID_KLP == $seminar->ID_KLP){?>
                            <td><?php echo $mahasiswa->NAMA_PERUSAHAAN; break;?></td>
                            <?php }}
                                foreach($bimbing as $dosen){
                                    if($dosen->ID_KLP == $seminar->ID_KLP){?>
                            <td><?php echo $dosen->NAMA_DSN; break;?></td>
                                    <?php }}?>
                            <td><?php echo $seminar->NAMA_DSN; ?></td>
                            <?php $skip = true; } else {?>
                            <td><?php echo $seminar->NAMA_DSN; ?></td>
                        </tr>
                            <?php $number++; $skip = false;} }?>
                        <!--tr>
                            <td>2</td>
                            <td>20 Maret 2013 / 07.00 / IF001</td>
                            <td>
                                <ul>
                                    <li>123123 Tuti Atut</li>
                                    <li>123123 Dadang EWP</li>
                                    <li>123123 Gery Fauzi Bowo</li>
                                </ul>
                            </td>
                            <td>Juli-Agustus</td>
                            <td>2013</td>
                            <td>PT Dirgantara</td>
                            <td>Mr X</td>
                            <td>Mr Y</td>
                            <td>Mr Z</td>
                        </tr-->
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>