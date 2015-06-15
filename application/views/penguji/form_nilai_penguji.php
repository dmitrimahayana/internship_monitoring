<div style="width: auto;height: 350px;overflow-y: auto;">
    <h1>Form Penilaian Dosen Penguji</h1>
    <h3>Kelompok KLP<?php echo $idklp; ?></h3>
    <form action="<?php echo base_url();?>penguji/update/nilai" method="post" enctype="multipart/form-data">
		<table>
                    <tr>
                        <td>
                            <b>No.</b>
                        </td>
                            <th style="width: 20%">
                            <b>Kriteria</b>
                        </td>
                        <td>
                            <b>Indikator Penilaian</b>
                        </td>
                        <td>
                            <b>Nilai</b>
                        </td>
                    </tr>
                    <tr>
                        <td><b>1</b></td>
                        <td>
                            Permasalahan
                        </td>
                        <td style="width: 250px">
                            Penguasaan terhadap permasalahan dan tujuan kerja praktek
                        </td>
                        <td>
                            <?php $nilai1 = ($jenis=='Penguji1')?$nklp->NILAI1_PENGUJI1:$nklp->NILAI1_PENGUJI2;for($i=5;$i<=10;$i++){?>
                            <input name="1" type="radio" <?php echo ($i==$nilai1)?'checked':''; ?> value="<?php echo $i;?>" ><?php echo $i;
                            }?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><b>2</b></td>
                        <td>
                            Metodologi
                        </td>
                        <td>
                            Ketepatan metode yang digunakan dan penguasaan pada metode, teknik, solusi, yang digunakan
                        </td>
                        <td>
                            <?php $nilai2 = ($jenis=='Penguji1')?$nklp->NILAI2_PENGUJI1:$nklp->NILAI2_PENGUJI2;for($i=5;$i<=10;$i++){?>
                            <input name="2" type="radio" <?php echo ($i==$nilai2)?'checked':''; ?> value="<?php echo $i;?>" ><?php echo $i;
                            }?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>3</b></td>
                        <td>
                            Tata Tulis
                        </td>
                        <td>
                            Bahasa, format dan sistematika buku kerja praktek
                        </td>
                        <td>
                             <?php $nilai3 = ($jenis=='Penguji1')?$nklp->NILAI3_PENGUJI1:$nklp->NILAI3_PENGUJI2;for($i=5;$i<=10;$i++){?>
                            <input name="3" type="radio" <?php echo ($i==$nilai3)?'checked':''; ?> value="<?php echo $i;?>" ><?php echo $i;
                            }?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>4</b></td>
                        <td>
                            Presentasi
                        </td>
                        <td>
                            Sistematika dan materi/bahan presentasi, obyektifitas dalam menanggapi pertanyaan dan mempertahankan pendapat
                        </td>
                        <td>
                             <?php $nilai4 = ($jenis=='Penguji1')?$nklp->NILAI4_PENGUJI1:$nklp->NILAI4_PENGUJI2;for($i=5;$i<=10;$i++){?>
                            <input name="4" type="radio" <?php echo ($i==$nilai4)?'checked':''; ?> value="<?php echo $i;?>" ><?php echo $i;
                            }?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            Catatan/Saran Dosen Penguji
                        </td>
                        <td colspan="2">
                            <textarea name="catatan" style="width: 80%;" rows="7"></textarea>
                        </td>
                    </tr>
                </table>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="idklp" value="<?php echo $idklp.','.$jenis?>">Save changes</button>
                </div>
            </form>
</div>