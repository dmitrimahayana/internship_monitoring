<!-- Modal -->
<div id="myModalFinal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel">Form Upload Final Project</h3>
    </div>
    <div class="modal-body">
        <form action="<?php echo base_url();?>mhs/update/project" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        Upload Buku KP
                    </td>
                    <td>
                        <input type="file" name="buku_kp" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Nama Project
                    </td>
                    <td>
                        <input type="text" name="nama_final_project" class="input-block-level" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Upload Project Terbaru / Final
                    </td>
                    <td>
                        <input type="file" name="final_project" />
                    </td>
                </tr>
                <tr>
            </table>
        
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </form>
</div>
    
