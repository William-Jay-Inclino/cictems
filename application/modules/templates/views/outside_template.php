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
    </style>
  </head>
<body class="Site">
  
  <header class="header">

    <nav class="animate-top navbar is-transparent is-fixed-top card">
      <div class="navbar-brand">
        <a class="navbar-item" href="https://bulma.io">
          <img src="<?php echo base_url() ?>assets/img/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
        </a>
        <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
      </div>
    
      <div id="navMenu" class="navbar-menu">
        <div class="navbar-end">
          <a class="navbar-item" href="<?php echo base_url() ?>login">
           Login
          </a>
          <a class="navbar-item" href="javascript:void(0)">
           Signup
          </a>
        </div>
      </div>

    </nav>
  </header>
  <br>
  <main class="Site-content">
    <?php
      $this->load->view($module.'/'.$module_view); 
    ?>
  </main>
    
    <script>
      
    

      document.addEventListener('DOMContentLoaded', function() {

        // Get all "navbar-burger" elements
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0)

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

          // Add a click event on each of them
          $navbarBurgers.forEach( el => {
            el.addEventListener('click', () => {

              // Get the target from the "data-target" attribute
              const target = el.dataset.target
              const $target = document.getElementById(target)

              // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
              el.classList.toggle('is-active')
              $target.classList.toggle('is-active')

            })
          })
        }

      }, false)



      </script>


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
  <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom-config.js"></script>
</body>
</html>