<!DOCTYPE html>
<html class="has-navbar-fixed-top">
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
  </head>
  <style>
    body{
      background-image: url("<?php echo base_url() ?>assets/img/bg-tile.png");
    }
    .my-title{
     background-color: #666666;
    -webkit-background-clip: text;
    -moz-background-clip: text;
    background-clip: text;
    color: transparent;
    text-shadow: rgba(255,255,255,0.5) 0px 3px 3px;
    }
    .table__wrapper {
      overflow-x: auto;
    }
  </style>
  <body class="Site">

      <header class="header">
         <nav class="animate-top navbar is-transparent is-fixed-top card">
          
            <div class="navbar-brand">
              <a class="navbar-item" href="https://bulma.io">
                <img src="<?php echo base_url() ?>assets/img/cictelogo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
              </a>
            </div>

           <div id="navbarExampleTransparentExample" class="navbar-menu">
             <div class="navbar-start">
              <a class="navbar-item <?php if($current_module == 0){echo 'nav-active';} ?>" href="<?php echo base_url() ?>dashboard">
                 Dashboard
              </a>
              <a class="navbar-item <?php if($current_module == 1){echo 'nav-active';} ?>" href="<?php echo base_url() ?>student/enrolment">
                 Enrolment
              </a>
              <a class="navbar-item <?php if($current_module == 2){echo 'nav-active';} ?>" href="<?php echo base_url() ?>student/my-classes">
                 My Classes
              </a>
              <a class="navbar-item <?php if($current_module == 3){echo 'nav-active';} ?>" href="<?php echo base_url() ?>student/class-schedules">
                 Class Schedules
              </a>
              <div class="navbar-item has-dropdown is-hoverable">
                 <a class="navbar-link <?php if($current_module == 4 || $current_module == 5){echo 'nav-active';} ?>" href="#">
                   Grades
                 </a>
                 <div class="navbar-dropdown is-boxed">
                  <a class="navbar-item <?php if($current_module == 4){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>student/grades-by-prospectus">
                   Prospectus
                 </a>
                   <a class="navbar-item <?php if($current_module == 5){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>student/grades-by-class">
                     Class
                   </a>
                 </div>
               </div>
               <div class="navbar-item has-dropdown is-hoverable">
                 <a class="navbar-link <?php if($current_module == 26){echo 'nav-active';} ?>" href="#">
                   Payments
                 </a>
                 <div class="navbar-dropdown is-boxed">
                  <a class="navbar-item <?php if($current_module == 26){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>student/fees">
                   Fees
                 </a>
                   <a class="navbar-item" href="<?php echo base_url() ?>student/payment-logs">
                     Logs
                   </a>
                 </div>
               </div>
             </div>

             <div class="navbar-end">
              <span class="navbar-item has-text-primary" href="javascript:void(0)">
                 <!-- SY: 2017-2018 | Sem: 2nd -->
                 <sub>
                  <?php echo '<span class="has-text-dark">Term:</span> '.$current_term->term; ?>  
                 </sub>
                 
               </span>
               <div class="navbar-item has-dropdown is-hoverable">
                  <a class="navbar-link" href="/documentation/overview/start/">
                    <?php echo $displayedName ?>
                  </a>
                  <div class="navbar-dropdown is-boxed is-right">
                    <a class="navbar-item <?php if($current_module == 100){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>profile">
                      <span class="icon has-text-primary">
                        <i class="fa fa-user"></i>
                      </span>
                     Profile
                   </a>
                   <a class="navbar-item <?php if($current_module == 101){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>settings">
                    <span class="icon has-text-primary">
                      <i class="fa fa-cog"></i>
                    </span> 
                    Settings
                   </a>
                   <a class="navbar-item" href="<?php echo base_url() ?>logout">
                    <span class="icon has-text-primary">
                        <i class="fa fa-power-off"></i>
                    </span>
                     Logout
                   </a>
                  </div>
               </div>
             </div>
           </div>
         </nav>
     </header>
        
      <main class="Site-content">
        <!-- main content here -->
        <?php
          $this->load->view($module.'/'.$module_view); 
        ?>

      </main>
      
      <br><br><br><br><br><br><br><br><br><br>
      
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