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
                <li style="margin-left: 10px;" class="active"><?php if(isset($username)){ ?><a href="<?php echo base_url(); ?>mhs/show/beranda">Home</a><?php } else { ?><a href="<?php echo base_url(); ?>home/view/home">Home</a><?php } ?></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">KLP<?php echo $username;    ?><b class="caret"></b></a>
                          <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url().'home/UpdatePassword/';echo (isset($nipDsn))?$nipDsn:'KLP'.$username;?>">Setting</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url().'login/log_out' ?>">Log out</a></li>
                          </ul>
                </li>
            </ul>
<!--            <form class="navbar-form pull-right" action="<?php echo base_url(); ?>galangan/search" method="post">
                <input type="text" class="search-query" name="cari" placeholder="Search">
            </form>-->
        </div>
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
