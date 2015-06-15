<div id="myModalSeminar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-header">
        <h3 id="myModalLabel">Pembuatan Seminar</h3>
    </div>
    <div class="modal-body">
        <form action="<?php echo base_url(); ?>koor/insert/listSeminar" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        Ruangan
                    </td>
                    <td>
                        <select multiple="multiple" name="ruangan">
                            <?php foreach($rng as $ruangan){?>
                            <option value="<?php echo $ruangan->ID_RUANG;?>"><?php echo $ruangan->NAMA_RUANGAN;?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Periode KP
                    </td>
                    <td>
                        <select name="periode">
                            <?php foreach($prd as $periode){?>
                            <option value="<?php echo $periode->ID_PERIODE;?>"><?php echo $periode->PERIODE;?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Tanggal
                    </td>
                    <td>
                        <input type="text" id="datepicker" name="tanggal"/>
                    </td>
                </tr>
                <tr>
                    <td>Jam :</td>
                    <td><select class="span1" name="jam">
                            <option>06</option>
                            <option>07</option>
                            <option>08</option>
                            <option>09</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                            <option>21</option>
                        </select>
                        Menit : <select class="span1" name="menit">
                            <option>00</option>
                            <option>05</option>
                            <option>10</option>
                            <option>15</option>
                            <option>20</option>
                            <option>25</option>
                            <option>30</option>
                            <option>35</option>
                            <option>40</option>
                            <option>45</option>
                            <option>50</option>
                            <option>55</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Dosen Penguji 1
                    </td>
                    <td>
                        <select name="penguji1">
                            <?php foreach($dsn as $dosen){
                                if($dosen->PEMBIMBING == 0){?>
                            <option value="<?php echo $dosen->NIP_DSN; ?>"><?php echo $dosen->NAMA_DSN?></option>
                                <?php }}?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Dosen Penguji 2
                    </td>
                    <td>
                        <select name="penguji2">
                            <?php foreach($dsn as $dosen){
                                if($dosen->PEMBIMBING == 0){?>
                            <option value="<?php echo $dosen->NIP_DSN; ?>"><?php echo $dosen->NAMA_DSN?></option>
                                <?php }}?>
                        </select>
                    </td>
                </tr>
            </table>
        
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Save changes</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </form>
</div>