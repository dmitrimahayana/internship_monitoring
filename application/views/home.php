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
              <li  style="margin-left: 10px;" class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
            
<!--            <form class="navbar-form pull-right" action="<?php echo base_url(); ?>galangan/search" method="post">
                <input type="text" class="search-query" name="cari" placeholder="Search">
            </form>-->
        </div><!--/.nav-collapse -->
      </div>
    </div>
</div>

<!-- Subhead
================================================== -->
<header class="jumbotron subhead" id="overview">
    <div class="container">
        <h1>SIMON KP</h1>
        <p class="lead">Sistem Informasi Monitoring Kerja Praktek</p>
    </div>
</header>

<div class="container">
    <!-- Docs nav
    ================================================== -->
    <div class="row">
        <div class="span3 " style="margin-top: 20px;">
            <h3>Login</h3>
            <table>
                 <form class="" action="<?php echo base_url(); ?>home/cek_login" method="POST" style="padding-top: 20px;">
                <tr>
                    <td><label class="control-label" for="" color="red"><i><font color="red"><?php echo $this->session->userdata('error');$this->session->unset_userdata('error');//validation_errors(); ?></font></i></label></td>
                </tr>
                <tr>
                    <td><label class="control-label" for="inputUsername">Username</label></td>
                    <td><input type="text" class="input-block-level" name="username" id="username" placeholder="Username"></td>

                </tr>
                <tr>
                    <td><label class="control-label" for="inputPassword">Password</label></td>
                    <td><input class="input-block-level" type="password" name="password" id="password" placeholder="Password"></td>
                </tr>
                <tr>
                    <td><button style="" id="submit" class="btn btn-primary" type="submit">Submit</button></td>
                    </form>
                    <td><button style="float:right" class="btn" onclick="location.href='<?php echo base_url(); ?>signup'">Sign up</button></td>
                </tr>
            </table>
        </div>
 
        <div class="span8" >
            <div style="padding-top: 30px;">
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
<!--            <h2>Pengumuman</h2>
            p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn" href="#">View details &raquo;</a></p-->

        </div>
    </div>