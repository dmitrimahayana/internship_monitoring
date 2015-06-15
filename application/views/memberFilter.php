<table>
    <tr>
        <td>
            Anggota 
        </td>
        <td>
<!--            <input style="margin-left: 36%;width:103%;" type="text" name="project" id="project" placeholder="Masukkan NRP"/>-->
        <input style="margin-left: 24%;" type="text" name="project" id="project" placeholder="Masukkan NRP"/>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <textarea name="memberValue" id="memberValue" style="width: 100%;visibility: hidden;"></textarea>
        </td>
    </tr>
</table>
<table style="background:#F8F8F8 " class="membertable table-hover table-condensed">
    <thead>
        <tr>
            <th style="width: 20%">No</th><th style="width: 20%">NRP</th><th style="width: 40%">Nama</th><th style="width: 20%">Act</th>
        </tr>
    </thead>
    <tbody id="member">
    </tbody>
    <tr>
        <td colspan='2'><button type="button" class='btn-danger' onclick='javascript:deleteAct("all");'>Clear All</button></td>
    </tr>
</table>
<script>
    $('#memberValue').val("");
    var count=0;
    var nameCount=[];
    var rowCount=[];
    var labelCount=[];
    var nameCount=[];
    $('.membertable').css('display','none');
    var projects = [
        //isi hasil query NRP mu dari oracle
        <?php foreach ($mhs as $mahasiswa) {?>
        {
            value: "<?php echo $mahasiswa->NRP.'+'.$mahasiswa->NAMA_MHS; ?>",
            label: "<?php echo $mahasiswa->NRP; ?>",
            name: "<?php echo $mahasiswa->NAMA_MHS; ?>"
        },
        <?php }?>
            
        
    ];
    $( "#project" ).autocomplete({
        minLength: 0,
        source: projects,
        focus: function( event, ui ) {
            $( "#project" ).val( ui.item.label );
            return false;
        },
        select: function( event, ui ) {
            $( "#project" ).val( ui.item.label );
            nameCount.push(ui.item.name);
            labelCount.push(ui.item.label);
            rowCount.push(count+"+"+ui.item.value);
            var no=rowCount.length;
            $('.membertable').css('display','block');
            $("#member").html("<tbody id='member'></tbody>");
            for(var i=0; i<rowCount.length; i++){
                var noNew=i+1;
                $('#member').append("<tr class='"+i+"'><td><center>"+noNew+"</center></td><td><center>"+labelCount[i]
                    +"</center></td><td><center>"+nameCount[i]
                    +"</center></td><td><center><button class='btn-danger' onclick='javascript:deleteAct("
                    +'"'+rowCount[i]+'","'+count+'","'+nameCount[i]+'","'+labelCount[i]+'"'+")'>Delete</button></center></td></tr>");
            }
            $('#memberValue').val(rowCount.valueOf());
            count++;
            return false;
        }
    })
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li>" )
        .append( "<a>" + item.label + "</a>" )
        .appendTo( ul );
    };
    function deleteAct(value,count,name,label){
        if(value=="all"){
            rowCount=[];
            $("#member").html("<tbody id='member'></tbody>");
            $('#memberValue').val("");
            $('.membertable').css('display','none');
        }
        else{
            var rowNum=rowCount.indexOf(value);
            rowCount.splice(rowNum, 1);
            nameCount.splice(rowNum, 1);
            labelCount.splice(rowNum, 1);
            if(rowCount.length==0){
                $('.membertable').css('display','none');
            }
            else{
                $('.membertable').css('display','block');
            }
            $("#member").html("<tbody id='member'></tbody>");
            for(var i=0; i<rowCount.length; i++){
                var noNew=i+1;
                $('#member').append("<tr class='"+i+"'><td><center>"+noNew+"</center></td><td><center>"+labelCount[i]
                    +"</center></td><td><center>"+nameCount[i]
                    +"</center></td><td><center><button class='btn-danger' onclick='javascript:deleteAct("
                    +'"'+rowCount[i]+'","'+count+'","'+nameCount[i]+'","'+labelCount[i]+'"'+")'>Delete</button></center></td></tr>");
            }
            $('#memberValue').val(rowCount.valueOf());
        }
    }
</script>