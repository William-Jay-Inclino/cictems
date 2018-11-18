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
          <a class="navbar-item bg-primary has-text-white no-hover" href="javascript:void(0)">
           Signup
          </a>
        </div>
      </div>

    </nav>
  </header>
  <br>
  <main class="Site-content">
    <script src="<?php echo base_url(); ?>assets/vendor/vue/vue.js"></script>
    <section id="app" class="section" v-cloak>
      <div class="container" style="max-width: 500px">
        <h3 class="title is-3 has-text-centered has-text-primary">Sign up</h3>
        <div class="box">
          <figure class="image is-128x128 has-image-centered">
            <img src="<?php echo base_url(); ?>assets/img/signup.png">
          </figure>
          <hr>
          <form action="" method="post">
            <div class="field">
                <label class="label">Username</label>
                <div class="control">
                    <input class="input" type="text">
                </div>
            </div>
            <div class="field">
                <label class="label">Password</label>
                <div class="control">
                    <input class="input" type="password">
                </div>
            </div>
            <div class="field">
                <label class="label">Retype password</label>
                <div class="control">
                    <input class="input" type="password">
                </div>
            </div>
            <div class="field">
                <label class="label">Date of birth</label>
                <div class="control">
                    <input class="input" type="text">
                </div>
            </div>
            <div class="field">
                <label class="label">Address</label>
                <div class="control">
                    <input class="input" type="text">
                </div>
            </div>
            <div class="field">
                <label class="label">Contact number</label>
                <div class="control">
                    <input class="input" type="text">
                </div>
            </div>
            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" type="email">
                </div>
            </div>
          </form>
          
        </div>
      </div>
    </section>
  </main>
    
    <script>
    
      document.addEventListener('DOMContentLoaded', function() {

        new Vue({
            el: '#app',
            data: {
              
               
            },
            created() {
                
            },
            watch: {

            },
            computed: {

            },
            methods: {

            }
        })

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
  <script src="<?php echo base_url(); ?>assets/js/navBurger.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/vue/vue-resource.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom-config.js"></script>
</body>
</html>