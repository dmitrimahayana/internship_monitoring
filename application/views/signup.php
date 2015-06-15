<link rel="stylesheet" href="<?php echo base_url(); ?>css/smoothness/jquery-ui.css" />
<script src="<?php echo base_url(); ?>js/jquery-1.9.1.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>js/validation/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

<script>
        $(document).ready(function(){
            $("#registerForm").validationEngine();
        });
</script>
<style type="text/css">
      .form-signin {
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
</style>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="brand" style="float:left;" href="#"><img style="height: 72px;width: 100px" src="<?php echo base_url(); ?>img/Logo.png" /></a>
        <div class="nav-collapse collapse" style="padding-top: 20px;">
            <ul class="nav">
              <li class=""><?php if(isset($username)){ ?><a href="<?php echo base_url(); ?>home/view/home">Home</a>
                  <?php } else { ?><a href="<?php echo base_url(); ?>home/view/home">Home</a><?php } ?></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
            <form class="navbar-form pull-right" action="<?php echo base_url(); ?>galangan/search" method="post">
                <input type="text" class="search-query" name="cari" placeholder="Search">
            </form>
        </div><!--/.nav-collapse -->
      </div>
    </div>
</div>

<header class="jumbotron subhead" id="overview">
    <div class="container">
        <h1>SIMON KP</h1>
        <p class="lead">Sistem Informasi Monitoring Kerja Praktek</p>
    </div>
</header>
      
<div class="container">
    <!-- Example row of columns -->
    <form id="registerForm" name="registerForm" method="post" action="<?php echo base_url(); ?>signup/insert">   
    <div class="row">
        <div class="span4 form-signin" >
            <table>
                <tr>
                    <td colspan="2">
                        <h2 class="form-signin-heading">Please sign up</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo validation_errors(); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Password
                    </td>
                    <td>
                        <input type="password" id="password" name="password" class="input-block-level input validate[required,custom[onlyLetterNumber]] text-input" placeholder="Password">
                    </td>
                </tr>
                <tr>
                    <td>
                        Periode KP
                    </td>
                    <td>
                        <select name="periode_kp">
                             <?php foreach ($prd as $periode) {?>
                            <option value="<?php echo $periode->ID_PERIODE?>"><?php echo $periode->PERIODE?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Jenjang Pendidikan
                    </td>
                    <td>
                        <select id="jenjangPendidikan" name="jenjangPendidikan" onchange="showJenjang()">
                            <option>D3</option>
                            <option>D4</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div id="memberShowFilter"></div>
            <br/>
            <table>
                <tr>
                    <td>
                        <button id="submit" class="btn btn-primary" type="submit">Submit</button>
                    </td>
                    <td style="width: 80%;">
                        <button type="button" style="float: right" class="btn" onclick="location.href='<?php echo base_url(); ?>home/view/home'">Cancel</button>
                    </td>
                </tr>
            </table>
        </div>
        <div class="span7" style="padding-top: 10px">
            <div id="myCarousel" class="carousel slide">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner">
                    <div class="active item"><img src="<?php echo base_url(); ?>img/bootstrap-mdo-sfmoma-01.jpg" /></div>
                    <div class="item"><img src="<?php echo base_url(); ?>img/bootstrap-mdo-sfmoma-02.jpg" /></div>
                    <div class="item"><img src="<?php echo base_url(); ?>img/bootstrap-mdo-sfmoma-03.jpg" /></div>
                </div>
                <!-- Carousel nav -->
                <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
            </div>
        </div>
    </div>
    </form>

<style>
    .ui-autocomplete {
        max-height: 100px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
        }
        /* IE 6 doesn't support max-height
        * we use height instead, but this forces the menu to always be this tall
        */
        * html .ui-autocomplete {
        height: 100px;
    }
</style>

<script>
    showJenjang();

    function showJenjang(){
        inp=$('#jenjangPendidikan').val();
        $.ajax({
            type: "POST",
            dataType: "html",
            data: "input="+inp,
            url: "<?php echo base_url(); ?>home/getNrpFromPendidikan",
            success: function(data) { 
                //alert(inp);
                //alert('success');
                //alert(data);
                $('#memberShowFilter').html(data);
                
            }, 
            error: function(xhr,err){
                alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
            }
        });
    }
    
</script>

