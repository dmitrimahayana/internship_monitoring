<?php $this->load->view('template/header'); ?>
<meta http-equiv="refresh" content="10;url=http://localhost/simonKP/home/view/home" />
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
              <li class=""><?php if(isset($username)){ ?><a href="<?php echo base_url(); ?>home/view/home">Home</a><?php } else { ?><a href="<?php echo base_url(); ?>home/view/home">Home</a><?php } ?></li>
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

    <div class="row">
        <div class="span11" style="padding-top: 10px">
            <center><h3>Informasi Kelompok</h3>
                Username : KLP<?php echo $idklp; ?><br/>
                Password : <?php echo $password; ?><br/>
                Anggota Kelompok : <br/>
                <?php if(isset($members)){
                    for($i=0;$i< sizeof($members);$i+=2){
                        echo $members[$i].' '.$members[$i+1].'<br/>';
                    }
                } ?>
                <h3>Halaman ini akan redirect ke login dalam 10 detik</h3>
            </center>
            <br/><br/><br/><br/>
        </div>
    </div>
<?php $this->load->view('template/footer'); ?>