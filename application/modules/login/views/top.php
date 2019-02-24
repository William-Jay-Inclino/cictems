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
      body{
      background-image: url("<?php echo base_url() ?>assets/img/bg-tile.png");
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
      
      <!-- <?php 
        $loginClass = $regClass = "class = 'navbar-item'";
        if($page == 'index'){
          $loginClass = "class = 'navbar-item bg-primary has-text-white no-hover'";
        }
        if($page == 'register'){
          $regClass = "class = 'navbar-item bg-primary has-text-white no-hover'";
        }
      ?>
      
      <?php 
        if($page == 'index' || $page == 'register'){ ?>
          <div id="navMenu" class="navbar-menu">
            <div class="navbar-end">
              <a <?php echo $loginClass; ?> href="<?php echo base_url() ?>">
               Login
              </a>
              <a <?php echo $regClass; ?> href="<?php echo base_url() ?>register">
               Register
              </a>
            </div>
          </div>
          <?php
        }
      ?> -->
      

    </nav>
  </header>
  <br>



  <main class="Site-content">