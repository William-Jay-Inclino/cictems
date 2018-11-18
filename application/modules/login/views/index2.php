<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/cicte_logo.png" type="image/x-icon" />
    <title>Log In</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma/bulma.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/css/main.css">
  </head>
  <body>
    <div class="columns is-vcentered">
      <div class="login column is-4 ">
        <section class="section">
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
          <div class="has-text-centered">
              <img class="login-logo" src="<?php echo base_url(); ?>assets/img/cicte_logo.png">
          </div>
          
            <?php echo form_open(base_url() . 'login/login_validation'); ?>
            <div class="field">
              <label class="label">Username</label>
              <div class="control has-icons-right">
                <input class="input" type="text" name="un" required autofocus>
                <span class="icon is-small is-right">
                  <i class="fa fa-user"></i>
                </span>
              </div>
              <?php echo form_error('un'); ?>
            </div>

            <div class="field">
              <label class="label">Password</label>
              <div class="control has-icons-right">
                <input class="input" type="password" name="pw" required>
                <span class="icon is-small is-right">
                  <i class="fa fa-key"></i>
                </span>
              </div>
              <?php echo form_error('pw'); ?>
            </div>
            <div class="has-text-centered">
              <!-- <a class="button is-vcentered is-primary is-outlined">Login</a> -->
              <input type="submit" class="button is-vcentered is-primary is-outlined" value="Login">
            </div>

          <?php echo form_close(); ?>
          
          <div class="has-text-centered">
            <a href="<?php echo base_url() ?>signup"> Don't you have an account? Sign up now!</a>
          </div>
        </section>
      </div>
      <div id="particles-js" class="interactive-bg column is-8">
      </div>
    </div>
    
    <script src="<?php echo base_url(); ?>assets/login/js/particles.js"></script>
    <script src="<?php echo base_url(); ?>assets/login/js/main.js"></script>
  </body>
</html>
