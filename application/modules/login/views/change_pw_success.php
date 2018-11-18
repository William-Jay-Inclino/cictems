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
      .gray-msg{
        color: #808eae;
        font-weight: bold;
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

    </nav>
  </header>
  <br>



  <main class="Site-content">
    <section class="section">
      <div class="container" style="max-width: 500px">
        <div class="box">
          <h3 class="title is-3 has-text-centered has-text-success">Success <i class="fa fa-check"></i> </h3>
          <hr>
          <p class="gray-msg">Password successfully change!</p>
          <hr>
          <div style="text-align: center">
            <a href="<?php echo base_url() ?>dashboard" class="button is-primary is-pulled-right">Continue</a> <br><br>
          </div>
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