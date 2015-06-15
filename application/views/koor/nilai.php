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
    function showClass(type, nrp){
        //alert(id_member+" "+type);
        $.ajax({
            type: "POST",
            dataType: "html",
            data: "type="+type+"&nrp="+nrp,
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
                
                function cek_nilai(nilai, idtag){
                    //alert(nilai+" "+idtag);
                    if(nilai>=81 && nilai<=100 ){
                        $(idtag).html("<td id='"+idtag+"'>A</td>");
                    }
                    else if(nilai>=71 && nilai<=80 ){
                        $(idtag).html("<td id='"+idtag+"'>AB</td>");
                    }
                    else if(nilai>=66 && nilai<=70 ){
                        $(idtag).html("<td id='"+idtag+"'>B</td>");
                    }
                    else if(nilai>=61 && nilai<=65 ){
                        $(idtag).html("<td id='"+idtag+"'>BC</td>");
                    }
                    else if(nilai>=56 && nilai<=60 ){
                        $(idtag).html("<td id='"+idtag+"'>C</td>");
                    }
                    else if(nilai>=41 && nilai<=55 ){
                        $(idtag).html("<td id='"+idtag+"'>D</td>");
                    }
                    else if(nilai>=0 && nilai<=40 ){
                        $(idtag).html("<td id='"+idtag+"'>E</td>");
                    }
                }

                cek_nilai($('#estetika').val(),'#nilai_estetika');
                cek_nilai($('#adaptasi').val(),'#nilai_adaptasi');
                cek_nilai($('#inisiatif').val(),'#nilai_inisiatif');
                cek_nilai($('#pendapat').val(),'#nilai_pendapat');
                cek_nilai($('#pengetahuan').val(),'#nilai_pengetahuan');
                cek_nilai($('#kerjasama').val(),'#nilai_kerjasama');
                cek_nilai($('#kesungguhan').val(),'#nilai_kesungguhan');
                cek_nilai($('#disiplin').val(),'#nilai_disiplin');
                cek_nilai($('#sopan').val(),'#nilai_sopan');
                cek_nilai($('#tnggungjwb').val(),'#nilai_tnggungjwb');
                cek_nilai($('#kehadiran').val(),'#nilai_kehadiran');
                cek_nilai($('#keselamatan').val(),'#nilai_keselamatan');
                cek_nilai($('#laporan').val(),'#nilai_laporan');
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
                <li><a href="<?php echo base_url().'koor/show/daftarPerusahaan' ?>" >List Perusahaan</a></li>
                <li class="active"><a href="<?php echo base_url().'koor/show/nilai' ?>" >Nilai Perusahaan</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <h1>Nilai Perusahaan</h1>
                <?php $this->load->view('koor/modalSeminar'); ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tempat KP</th>
                            <th>Periode</th>
                            <th>Tahun</th>
                            <th>Kelompok</th>
                            <th>NRP</th>
                            <th>Nama Mhs</th>
                            <th>Nilai</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php //echo $links; ?>
                        <?php $number = 1; foreach($prsh as $perusahaan){
                            $mhs = array();
                            foreach($nmp as $row){
                                if($row->ID_KLP == $perusahaan->ID_KLP){
                                array_push($mhs, $row);
                                }
                            }
                             $totalRowspan = count($mhs)+1;
                             //echo '<script>alert("'.$totalRowspan.'")</script>';
                        ?>
                        <tr>
                            <td rowspan="<?php echo $totalRowspan;?>"><?php echo $number;?></td>
                            <td rowspan="<?php echo $totalRowspan;?>"><?php echo $mhs[0]->NAMA_PERUSAHAAN;?></td>
                            <td rowspan="<?php echo $totalRowspan;?>"><?php foreach($kp as $prd){ if($prd->ID_KLP == $mhs[0]->ID_KLP){echo $prd->PERIODE; break;}}?></td>
                            <td rowspan="<?php echo $totalRowspan;?>">2013</td>
                        </tr>
                            <?php for($i = 0; $i<$totalRowspan-1; $i++){?>
                        <tr>
                            <td><?php if(!$i){?>KLP<?php echo $mhs[$i]->ID_KLP; }?></td>
                            <td><?php echo $mhs[$i]->NRP;?></td>
                            <td><?php echo $mhs[$i]->NAMA_MHS;?></td>
                            <td><?php echo $mhs[$i]->NILAI_MHS_PERUSAHAAN;?></td>
                            <td>
                                <button  class="btn btn-info" onclick="showClass('nilai', <?php echo $mhs[$i]->NRP;?>)">Update Nilai</button>
                            </td>
                         </tr>
                        <?php }$number++;}?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>