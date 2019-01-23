<?php 
  
  if(($current_module == 1 && $shared_data['enrol_status'] == 'inactive') || ($current_module == 2 && $shared_data['stud_enrol_status'] != 'Enrolled')){
    show_404();
  }

?>
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
              <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
              </a>
            </div>

           <div id="navMenu" class="navbar-menu">
             <div class="navbar-start">
              <a class="navbar-item <?php if($current_module == 0){echo 'nav-active';} ?>" href="<?php echo base_url() ?>student/dashboard">
                 Dashboard
              </a>
              <?php 
                if($shared_data['enrol_status'] == 'active'){ ?>
                  <a class="navbar-item <?php if($current_module == 1){echo 'nav-active';} ?>" href="<?php echo base_url() ?>student/enrolment">
                    Enrolment
                  </a>
                  <?php
                }

                if($shared_data['stud_enrol_status'] == 'Enrolled'){ ?>
                  <a class="navbar-item <?php if($current_module == 2){echo 'nav-active';} ?>" href="<?php echo base_url() ?>student/my-classes">
                     My Classes
                  </a>
                  <?php
                }
              ?>
              <a class="navbar-item <?php if($current_module == 3){echo 'nav-active';} ?>" href="<?php echo base_url() ?>student/class-schedules">
                 Class Schedules
              </a>
              <a class="navbar-item <?php if($current_module == 8){echo 'nav-active';} ?>" href="<?php echo base_url() ?>student/prospectus">
                 Prospectus
              </a>
              <div class="navbar-item has-dropdown is-hoverable">
                 <a class="navbar-link <?php if($current_module == 4 || $current_module == 5){echo 'nav-active';} ?>" href="javascript:void(0)">
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
                 <a class="navbar-link <?php if($current_module == 6 || $current_module == 7){echo 'nav-active';} ?>" href="javascript:void(0)">
                   Payments
                 </a>
                 <div class="navbar-dropdown is-boxed">
                  <a class="navbar-item <?php if($current_module == 6){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>student/fees">
                   Fees
                 </a>
                   <a class="navbar-item <?php if($current_module == 7){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>student/payment-logs">
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
                  <a class="navbar-link" href="javascript:void(0)">
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
      
      <footer class="footer bg-white">
        <div class="container">
          <div class="content has-text-centered">
              Developed by <a href="#" class="has-text-primary"><b>Team RAWR</b></a>. Copyright &copy; <?php echo date("Y"); ?> All Rights Reserved
          </div>
        </div>
      </footer>
      
      <script src="<?php echo base_url(); ?>assets/js/navBurger.js"></script>
     <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom.min.js"></script>
     <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom-config.js"></script>
  </body>
</html>