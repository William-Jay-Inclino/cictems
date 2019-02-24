<section class="section">
  <div class="container" style="max-width: 500px"> <br>
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
        </div>
        
      <?php echo form_close(); ?>
      
    </div>
  </div>
</section>