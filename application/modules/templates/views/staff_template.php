<!DOCTYPE html>
<html class="has-navbar-fixed-top">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/cicte_logo.png" type="image/x-icon" />
    <title>CICTE</title>
    <!-- <script src="<?php echo base_url(); ?>assets/vendor/pace/pace.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/pace/pace-theme-minimal.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma/bulma.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/headroom/headroom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    <style>
    body{
      background-image: url("<?php echo base_url() ?>assets/img/bg-tile.png");
    }
  </style>
  </head>
  <body class="Site">

      <header class="header">
         <nav class="animate-top navbar is-transparent is-fixed-top card">
          
            <div class="navbar-brand">
              <a class="navbar-item" href="javascript:void(0)">
                <img src="<?php echo base_url() ?>assets/img/cictelogo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
              </a>
            </div>

           <div id="navbarExampleTransparentExample" class="navbar-menu">
             <div class="navbar-start">
              <!-- <a class="navbar-item <?php if($current_module == 0){echo 'nav-active';} ?>" href="<?php echo base_url() ?>dashboard">
                 Dashboard
               </a> -->
               <?php 
                if(in_array('1', $user_access)){ ?>
                  <a class="navbar-item <?php if($current_module == 1){echo 'nav-active';} ?>" href="<?php echo base_url() ?>classes">
                   Classes
                 </a>
                  <?php
                }
                if(in_array('25', $user_access)){ ?>
                  <a class="navbar-item <?php if($current_module == 25){echo 'nav-active';} ?>" href="<?php echo base_url() ?>e-confirmation">
                   E-Confirmation
                 </a>
                  <?php
                }
                if($module_category['trans']){ ?>
                  <div class="navbar-item has-dropdown is-hoverable">
                   <a class="navbar-link <?php if($current_module >= 2 && $current_module <= 4){echo 'nav-active';} ?>" href="#">
                   Transactions
                 </a>
                   <div class="navbar-dropdown is-boxed">
                    <?php 
                      if(in_array('2', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 2){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>enrollment">
                         Enrollment
                       </a>
                        <?php
                      }
                      if(in_array('3', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 3){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>grade">
                         Grade
                       </a>
                        <?php
                      }
                      if(in_array('4', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 4){echo 'nav-active2';} ?>" href="https://bulma.io/documentation/elements/box/">
                         Payment
                       </a>
                        <?php
                      }
                     ?>
                   </div>
                 </div>
                  <?php
                }
                if($module_category['main']){ ?>
                  <div class="navbar-item has-dropdown is-hoverable">
                   <a class="navbar-link <?php if($current_module >= 5 && $current_module <= 13){echo 'nav-active';} ?>" href="#">
                     Maintenance
                   </a>
                   <div class="navbar-dropdown is-boxed">
                    <?php 
                      if(in_array('5', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 5){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/term">
                         Term
                       </a>
                        <?php
                      }
                      if(in_array('6', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 6){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/room">
                         Room
                       </a>
                        <?php
                      }
                      if(in_array('7', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 7){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/course">
                         Course
                       </a>
                        <?php
                      }
                      if(in_array('8', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 8){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/prospectus">
                         Prospectus
                       </a>
                        <?php
                      }
                      if(in_array('9', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 9){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/section">
                         Section
                       </a>
                        <?php
                      }
                      if(in_array('10', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 10){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/subject">
                         Subject
                       </a>
                        <?php
                      }
                      if(in_array('11', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 11){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/class">
                         Class
                       </a>
                        <?php
                      }
                      if(in_array('12', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 12){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/grade-formula">
                         Grade Formula
                       </a>
                        <?php
                      }
                      if(in_array('13', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 13){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/fees">
                         Fees
                       </a>
                        <?php
                      }
                    ?>
                   </div>
                 </div>
                  <?php
                }
                if($module_category['users']){ ?>
                  <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link <?php if($current_module >= 14 && $current_module <= 17){echo 'nav-active';} ?>" href="#">
                       Users
                     </a>
                   <div class="navbar-dropdown is-boxed">
                    <?php 
                      if(in_array('14', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 14){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>users/student">
                         Student
                       </a>
                        <?php
                      }
                      if(in_array('15', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 15){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>users/faculty">
                         Faculty
                       </a>
                        <?php
                      }
                      if(in_array('16', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 16){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>users/staff">
                         Staff
                       </a>
                        <?php
                      }
                      if(in_array('17', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 17){echo 'nav-active2';} ?>" href="https://bulma.io/documentation/elements/box/">
                         Guardian
                       </a>
                        <?php
                      }
                    ?>
                   </div>
                 </div>
                  <?php
                }
                if($module_category['reports']){ ?>
                  <div class="navbar-item has-dropdown is-hoverable">
                   <a class="navbar-link <?php if($current_module >= 18 && $current_module <= 22){echo 'nav-active';} ?>" href="#">
                   Reports
                 </a>
                   <div class="navbar-dropdown is-boxed">
                    <?php 
                      if(in_array('18', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 18){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>reports/prospectus">
                         Prospectus
                       </a>
                        <?php
                      }
                      if(in_array('19', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 19){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>reports/student">
                         Student
                       </a>
                        <?php
                      }
                      if(in_array('20', $user_access)){ ?>
                         <a class="navbar-item <?php if($current_module == 20){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>reports/grade">
                           Grade
                         </a>
                        <?php
                      }
                      if(in_array('21', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 21){echo 'nav-active2';} ?>" href="https://bulma.io/documentation/elements/box/">
                         Fees
                       </a>
                        <?php
                      }
                      if(in_array('22', $user_access)){ ?>
                        <a class="navbar-item <?php if($current_module == 22){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>reports/class">
                         Class Schedules
                       </a>
                        <?php
                      }
                    ?>
                   </div>
                 </div>
                  <?php
                }
               ?>
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
        <script src="<?php echo base_url(); ?>assets/vendor/vue/vue.min.js"></script>
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

     
     <script src="<?php echo base_url(); ?>assets/vendor/vue/vue-resource.js"></script>
     <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom.min.js"></script>
     <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom-config.js"></script>
  </body>
</html>