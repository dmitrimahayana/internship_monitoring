<div style="width: auto;height: 350px;overflow-y: auto;">
    <h1>Form Penilaian Dosen Pembimbing</h1>
    <h3>Kelompok KLP<?php echo $idklp; ?></h3>
            <form action="<?php echo base_url();?>pembimbing/update/nilai" method="post" enctype="multipart/form-data">
                <table class="table table-striped" >
                    <thead>
                        <tr>
                            <th>
                                <b>No.</b>
                            </th>
                            <th style="width: 20%">
                                <b>Kriteria</b>
                            </th>
                            <th>
                                <b>Indikator Penilaian</b>
                            </th>
                            <th>
                                <b>Nilai</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>1</b></td>
                            <td>
                                Permasalahan
                            </td>
                            <td style="width: 250px">
                                Penguasaan terhadap permasalahan dan tujuan kerja praktek
                            </td>
                            <td>
                                <?php $nilai1 = $nklp->NILAI1_PEMBIMBING;for($i=5;$i<=10;$i++){?>
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
                                <?php $nilai2 = $nklp->NILAI2_PEMBIMBING;for($i=5;$i<=10;$i++){?>
                                <input name="2" type="radio" <?php echo ($i==$nilai2)?'checked':''; ?> value="<?php echo $i;?>" ><?php echo $i;
                                }?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>3</b></td>
                            <td>
                                Konsultasi
                            </td>
                            <td>
                                Keaktifan mahasisa berkonsultasi dengan dosen pembimbing
                            </td>
                            <td>
                                <?php $nilai3 = $nklp->NILAI3_PEMBIMBING;for($i=5;$i<=10;$i++){?>
                                <input name="3" type="radio" <?php echo ($i==$nilai3)?'checked':''; ?> value="<?php echo $i;?>" ><?php echo $i;
                                }?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>4</b></td>
                            <td>
                                Tata Tulis
                            </td>
                            <td>
                                Bahasa, format dan sistematika buku kerja praktek
                            </td>
                            <td>
                                <?php $nilai4 = $nklp->NILAI4_PEMBIMBING;for($i=5;$i<=10;$i++){?>
                                <input name="4" type="radio" <?php echo ($i==$nilai4)?'checked':''; ?> value="<?php echo $i;?>" ><?php echo $i;
                                }?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>5</b></td>
                            <td>
                                Presentasi
                            </td>
                            <td>
                                Sistematika dan materi/bahan presentasi, obyektifitas dalam menanggapi pertanyaan dan mempertahankan pendapat
                            </td>
                            <td>
                                <?php $nilai5 = $nklp->NILAI5_PEMBIMBING;for($i=5;$i<=10;$i++){?>
                                <input name="5" type="radio" <?php echo ($i==$nilai3)?'checked':''; ?> value="<?php echo $i;?>" ><?php echo $i;
                                }?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                Catatan/Saran Dosen Pembimbing
                            </td>
                            <td colspan="2">
                                <textarea style="width: 80%;" rows="7"  name="catatan"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="idklp" value="<?php echo $idklp; ?>">Save changes</button>
                </div>
            </form>
</div>