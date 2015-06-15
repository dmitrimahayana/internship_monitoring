<!-- Modal -->
<div id="myModalBimbingan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel">Bimbingan</h3>
    </div>
    <form action="<?php echo base_url();?>mhs/insert/bimbingan" method="post" enctype="multipart/form-data">
    <div class="modal-body">
        <table>
            <tr>
                <td>
                    <textarea style="width: 100%" rows="4" placeholder="catatan Mahasiswa" name='catatan'></textarea>
                </td>
            </tr>
<!--            <tr>
                <td>
                    Upload Progress Project: <input type="file" name="final_project" />
                </td>
            </tr>-->
        </table>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="idklp" value="<?php echo $username?>">Submit</button>
        <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </form>
</div>