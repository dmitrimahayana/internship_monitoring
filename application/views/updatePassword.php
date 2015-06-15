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
              <li style="margin-left: 10px;" class="active">
                  <?php if(isset($nipDsn)){ ?><a href="<?php echo base_url().$jenis; ?>/show/beranda">Home</a>
                  <?php } else if(isset($username)){?><a href="<?php echo base_url();?>mhs/show/beranda">Home</a>
                      <?php } else { ?><a href="<?php echo base_url(); ?>home/view/home">Home</a><?php } ?>
              </li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo (!isset($jenis))?'KLP':'';echo $username;?><b class="caret"></b></a>
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
    <div class="row">
        <div class="span4" >
            <form name="updatePassword" action="<?php echo base_url(); ?>home/getNewPassword" method="POST">
            <table>
                <tr>
                    <td colspan="2">
                        <h2 class="">Change Password</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo validation_errors(); ?>
                    </td>
                </tr>
                <?php if(isset($nipDsn)){?>
                <tr>
                    <td> Nomor Induk</td>
                    <td>
                        <input type="text" name="nomor_induk" value="<?php echo $nipDsn;?>" readonly="true"/>
                    </td>
                </tr>
                <?php }?>
                <tr>
                    <td>
                        Nama User
                    </td>
                    <td>
                        <input type="text" name="nama_user" value="<?php if(!isset($nipDsn))echo 'KLP';echo $username;?>" readonly="true"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Password Lama
                    </td>
                    <td>
                        <input type="password" name="password_lama" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Password Baru
                    </td>
                    <td>
                        <input type="password" name="password_baru" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Konfirmasi Password
                    </td>
                    <td>
                        <input type="password" name="konfirmasi_password" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input class="btn btn-primary pull-right" type="submit" name="submit" /></td>
                </tr>
            </table>
            </form>
        </div>
    </div>
