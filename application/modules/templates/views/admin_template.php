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
              <a class="navbar-item" href="https://bulma.io">
                <img src="<?php echo base_url() ?>assets/img/cictelogo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
              </a>
            </div>

           <div id="navMenu" class="navbar-menu">
             <div class="navbar-start">
              <a class="navbar-item <?php if($current_module == 0){echo 'nav-active';} ?>" href="<?php echo base_url() ?>dashboard">
                 Dashboard
               </a>
               <a class="navbar-item <?php if($current_module == 1){echo 'nav-active';} ?>" href="<?php echo base_url() ?>classes">
                 Class Grades
               </a>
               <div class="navbar-item has-dropdown is-hoverable">
                 <a class="navbar-link <?php if($current_module == 26 || $current_module == 27){echo 'nav-active';} ?>" href="#">
                   Schedule
                 </a>
                 <div class="navbar-dropdown is-boxed">
                  <a class="navbar-item <?php if($current_module == 26){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>schedule">
                   Manual
                 </a>
                  <a class="navbar-item <?php if($current_module == 27){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>auto-schedule">
                   Automatic
                  </a>
                 </div>
               </div>
               <div class="navbar-item has-dropdown is-hoverable">
                 <a class="navbar-link <?php if($current_module >= 2 && $current_module <= 4){echo 'nav-active';} ?>" href="#">
                   Transactions
                 </a>
                 <div class="navbar-dropdown is-boxed">
                  <a class="navbar-item <?php if($current_module == 2){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>enrollment">
                     Enrollment
                   </a>
                   <a class="navbar-item <?php if($current_module == 2.1){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>incomplete">
                     Incomplete
                   </a>
                   <!-- <a class="navbar-item <?php if($current_module == 3){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>grade">
                     Grade
                   </a> -->
                   <a class="navbar-item <?php if($current_module == 4){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>payment">
                     Payment
                   </a>
                 </div>
               </div>
               <div class="navbar-item has-dropdown is-hoverable">
                 <a class="navbar-link <?php if($current_module >= 5 && $current_module <= 13){echo 'nav-active';} ?>" href="#">
                   Maintenance
                 </a>
                 <div class="navbar-dropdown is-boxed">
                  <a class="navbar-item <?php if($current_module == 5){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/term">
                     Term
                   </a>
                   <a class="navbar-item <?php if($current_module == 6){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/room">
                     Room
                   </a>
                   <a class="navbar-item <?php if($current_module == 7){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/course">
                     Course
                   </a>
                   <a class="navbar-item <?php if($current_module == 8){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/prospectus">
                     Prospectus
                   </a>
                   <a class="navbar-item <?php if($current_module == 9){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/section">
                     Section
                   </a>
                   <a class="navbar-item <?php if($current_module == 9.5){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/day">
                     Day
                   </a>
                   <a class="navbar-item <?php if($current_module == 10.5){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/specialization">
                     Subject Type
                   </a>
                   <a class="navbar-item <?php if($current_module == 10){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/subject">
                     Subject
                   </a>
                   <a class="navbar-item <?php if($current_module == 12){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/grade-formula">
                     Grade Formula
                   </a>
                   <a class="navbar-item <?php if($current_module == 13){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>maintenance/fees">
                     Departmental Fees
                   </a>
                 </div>
               </div>
               <div class="navbar-item has-dropdown is-hoverable">
                 <a class="navbar-link <?php if($current_module >= 14 && $current_module <= 17){echo 'nav-active';} ?>" href="#">
                   Users
                 </a>
                 <div class="navbar-dropdown is-boxed">
                  <a class="navbar-item <?php if($current_module == 14){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>users/student">
                     Student
                   </a>
                   <a class="navbar-item <?php if($current_module == 15){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>users/faculty">
                     Faculty
                   </a>
                   <a class="navbar-item <?php if($current_module == 16){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>users/staff">
                     Staff
                   </a>
                   <!-- <hr class="navbar-divider">
                   <a class="navbar-item <?php if($current_module == 16.5){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>users/registration">
                     Registration
                   </a> -->
                 </div>
               </div>
               <div class="navbar-item has-dropdown is-hoverable">
                 <a class="navbar-link <?php if($current_module >= 18 && $current_module <= 22){echo 'nav-active';} ?>" href="#">
                   Reports
                 </a>
                 <div class="navbar-dropdown is-boxed">
                  <a class="navbar-item <?php if($current_module == 18){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>reports/prospectus">
                     Prospectus
                   </a>
                   <a class="navbar-item <?php if($current_module == 19){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>reports/student">
                     Student
                   </a>
                   <a class="navbar-item <?php if($current_module == 20){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>reports/grade">
                     Grade
                   </a>
                   <!-- <a class="navbar-item <?php if($current_module == 20.5){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>reports/remark">
                     Remark
                   </a> -->
                   <a class="navbar-item <?php if($current_module == 21){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>reports/fees">
                     Departmental Fees
                   </a>
                   <a class="navbar-item <?php if($current_module == 21.5){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>reports/payment-logs">
                     Payment Logs
                   </a>
                   <a class="navbar-item <?php if($current_module == 22){echo 'nav-active2';} ?>" href="<?php echo base_url() ?>reports/class">
                     Schedules
                   </a>
                 </div>
               </div>
             </div>

             <div class="navbar-end">
              <span class="navbar-item has-text-primary" href="javascript:void(0)">
                 <!-- SY: 2017-2018 | Sem: 2nd -->
                 <a class="navbar-item has-text-primary" href="<?php echo base_url() ?>maintenance/term"><?php echo $current_term->term; ?></a>
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
        <script src="<?php echo base_url(); ?>assets/vendor/vue/vue.js"></script>
        <!-- main content here -->
        <?php
          $this->load->view($module.'/'.$module_view); 
        ?>

      </main>
      
      
      <footer class="footer bg-white">
        <div class="container">
          <div class="content has-text-centered">
              Developed by <a href="#" class="has-text-primary"><b>Team RAWR</b></a>. Copyright &copy; <?php echo date("Y"); ?> All Rights Reserved
          </div>
        </div>
      </footer>

     <!-- <script src="<?php echo base_url(); ?>assets/vendor/axios/axios.min.js"></script> -->
    <!--  <script src="<?php echo base_url(); ?>assets/js/navBurger.js"></script> -->
     <script src="<?php echo base_url(); ?>assets/vendor/vue/vue-resource.js"></script>
     <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom.min.js"></script>
     <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom-config.js"></script>
  </body>
</html>