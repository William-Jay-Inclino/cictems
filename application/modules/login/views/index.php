<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CICTE</title>
    <script src="<?php echo base_url(); ?>assets/vendor/pace/pace.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/pace/pace-theme-minimal.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma/bulma.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/headroom/headroom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    
    <style>
      .no-hover{
        pointer-events: none;
      }
      .has-image-centered {
        margin-left: auto;
        margin-right: auto;
      }
      .login-btn{
        width: 50%; font-size: 16px
      }
    </style>
  </head>
<body class="Site">
  
  <header class="header">

    <nav class="animate-top navbar is-transparent is-fixed-top card">
      <div class="navbar-brand">
        <a class="navbar-item" href="https://bulma.io">
          <img src="<?php echo base_url() ?>assets/img/cictelogo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
        </a>
        <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
      </div>
    
      <div id="navMenu" class="navbar-menu">
        <div class="navbar-end">
          <a class="navbar-item bg-primary has-text-white no-hover" href="javascript:void(0)">
           Login
          </a>
          <a class="navbar-item" href="<?php echo base_url() ?>register">
           Register
          </a>
        </div>
      </div>

    </nav>
  </header>
  <br>



  <main class="Site-content">
    <section class="section">
      <div class="container" style="max-width: 500px">
        <h3 class="title is-3 has-text-centered has-text-primary">Login</h3>
        <?php 
            if($this->session->flashdata("error")){ ?>
                <div class="message is-danger">
                  <div class="message-body has-text-centered">
                    <?php echo $this->session->flashdata("error"); ?>
                  </div>
                </div>
              <?php
            }
          ?>
        <div class="box">
          <figure class="image is-128x128 has-image-centered">
            <img src="<?php echo base_url(); ?>assets/img/cicte_logo.png">
          </figure>
          <hr>
          <?php echo form_open(base_url() . 'login/login_validation'); ?>
            <div class="field">
                <label class="label">Username</label>
                <div class="control has-icons-right">
                  <input class="input is-rounded" type="text" name="un" required autofocus>
                  <span class="icon is-small is-right">
                    <i class="fa fa-user"></i>
                  </span>
                </div>
                <?php echo form_error('un'); ?>
            </div>
            <div class="field">
                <label class="label">Password</label>
                <div class="control has-icons-right">
                <input class="input is-rounded" type="password" name="pw" required>
                <span class="icon is-small is-right">
                  <i class="fa fa-key"></i>
                </span>
              </div>
            </div>
            <br>
            <div style="text-align: center">
              <button class="button is-primary is-outlined login-btn">Login</button> <br><br>
              <a href="<?php echo base_url() ?>register"> Don't you have an account? Register now!</a>
            </div>
            
          <?php echo form_close(); ?>
          
        </div>
      </div>
    </section>
  </main>





  <footer class="footer bg-black">
    <div class="container">
      <div class="content has-text-centered">
        <h6 class="title is-6 has-text-white">
          Developed by <a href="#"><b>Team RAWR</b></a>. Copyright &copy; <?php echo date("Y"); ?> All Rights Reserved
        </h6>
      </div>
    </div>
  </footer>
  <script src="<?php echo base_url(); ?>assets/js/navBurger.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom-config.js"></script>
</body>
</html>