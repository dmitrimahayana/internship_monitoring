
    <h1>Form Penilaian KP</h1>
    <form action="<?php echo base_url();?>koor/update/nilai/<?php echo $mhs->NRP?>" method="post" enctype="multipart/form-data">
                <div  style="height: 300px;overflow-y: auto">
		<table>
                    <tr>
                        <td colspan="4"><?php echo $mhs->NRP.' '.$mhs->NAMA_MHS;?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>No</b>
                        </td>
                        <td>
                            <b>Jenis Penilaian</b>
                        </td>
                        <td>
                            <b>Nilai Angka</b>
                        </td>
                        <td style="width: 20%;">
                            <b>Nilai Huruf</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            Kemampuan dan Etika Bergaul
                        </td>
                        <td>
                            <input id="estetika" type="text" name="1" onchange="cek_nilai(this.value,'#nilai_estetika')" value="<?php echo $nmp->NILAI1; ?>" />
                        </td>
                        <td id='nilai_estetika'></td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>
                            Kemampuan Beradaptasi
                        </td>
                        <td>
                            <input id="adaptasi" type="text" name="2" onchange="cek_nilai(this.value,'#nilai_adaptasi')" value="<?php echo $nmp->NILAI2; ?>" />
                        </td>
                        <td id='nilai_adaptasi'></td>
                    </tr>
                    <tr>
                        <td>
                            3
                        </td>
                        <td>
                            Kemampuan Berinisiatif
                        </td>
                        <td>
                            <input id="inisiatif" type="text" name="3" onchange="cek_nilai(this.value,'#nilai_inisiatif')" value="<?php echo $nmp->NILAI3; ?>" />
                        </td>
                        <td id='nilai_inisiatif'></td>
                    </tr>
                    <tr>
                        <td>
                            4
                        </td>
                        <td>
                            Kemampuan Menyampaikan Pendapat
                        </td>
                        <td>
                            <input id="pendapat" type="text" name="4" onchange="cek_nilai(this.value,'#nilai_pendapat')" value="<?php echo $nmp->NILAI4; ?>" />
                        </td>
                        <td id='nilai_pendapat'></td>
                    </tr>
                    <tr>
                        <td>
                            5
                        </td>
                        <td>
                            Pengetahuan Tentang Pekerjaan
                        </td>
                        <td>
                            <input id="pengetahuan" type="text" name="5" onchange="cek_nilai(this.value,'#nilai_pengetahuan')" value="<?php echo $nmp->NILAI5; ?>" />
                        </td>
                        <td id='nilai_pengetahuan'></td>
                    </tr>
                    <tr>
                        <td>
                            6
                        </td>
                        <td>
                            Kemampuan Kerjasama Kelompok
                        </td>
                        <td>
                            <input id="kerjasama" type="text" name="6" onchange="cek_nilai(this.value,'#nilai_kerjasama')" value="<?php echo $nmp->NILAI6; ?>" />
                        </td>
                        <td id='nilai_kerjasama'></td>
                    </tr>
                    <tr>
                        <td>
                            7
                        </td>
                        <td>
                            Kesungguhan dalam Belajar
                        </td>
                        <td>
                            <input id="kesungguhan" type="text" name="7" onchange="cek_nilai(this.value,'#nilai_kesungguhan')" value="<?php echo $nmp->NILAI7; ?>" />
                        </td>
                        <td id='nilai_kesungguhan'></td>
                    </tr>
                    <tr>
                        <td>
                            8
                        </td>
                        <td>
                            Kedisiplinan
                        </td>
                        <td>
                            <input id="disiplin" type="text" name="8" onchange="cek_nilai(this.value,'#nilai_disiplin')" value="<?php echo $nmp->NILAI8; ?>" />
                        </td>
                        <td id='nilai_disiplin'></td>
                    </tr>
                    <tr>
                        <td>
                            9
                        </td>
                        <td>
                            Sopan Santun
                        </td>
                        <td>
                            <input id="sopan" type="text" name="9" onchange="cek_nilai(this.value,'#nilai_sopan')" value="<?php echo $nmp->NILAI9; ?>" />
                        </td>
                        <td id='nilai_sopan'></td>
                    </tr>
                    <tr>
                        <td>
                            10
                        </td>
                        <td>
                            Tanggung Jawab
                        </td>
                        <td>
                            <input id="tnggungjwb" type="text" name="10" onchange="cek_nilai(this.value,'#nilai_tnggungjwb')" value="<?php echo $nmp->NILAI10; ?>" />
                        </td>
                        <td id='nilai_tnggungjwb'></td>
                    </tr>
                    <tr>
                        <td>
                            11
                        </td>
                        <td>
                            Kehadiran
                        </td>
                        <td>
                            <input id="kehadiran" type="text" name="11" onchange="cek_nilai(this.value,'#nilai_kehadiran')" value="<?php echo $nmp->NILAI11; ?>" />
                        </td>
                        <td id='nilai_kehadiran'></td>
                    </tr>
                    <tr>
                        <td>
                            12
                        </td>
                        <td>
                            Keselamatan Kerja
                        </td>
                        <td>
                            <input id="keselamatan" type="text" name="12" onchange="cek_nilai(this.value,'#nilai_keselamatan')" value="<?php echo $nmp->NILAI12; ?>" />
                        </td>
                        <td id='nilai_keselamatan'></td>
                    </tr>
                    <tr>
                        <td>
                            13
                        </td>
                        <td>
                            Laporan Kerja
                        </td>
                        <td>
                            <input id="laporan" type="text" name="13" onchange="cek_nilai(this.value,'#nilai_laporan')" value="<?php echo $nmp->NILAI13; ?>" />
                        </td>
                        <td id='nilai_laporan'</td>
                    </tr>
                </table>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="nrp" value="<?php echo $mhs->NRP?>">Save changes</button>
                </div>
                </div>
            </form>

    <script>
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
        </script>