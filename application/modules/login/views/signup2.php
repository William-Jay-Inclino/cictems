<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/cicte_logo.png" type="image/x-icon" />
    <title>Log In</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma/bulma.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/signup.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">

  </head>
<body>
  <div id="login">
    <div class="login-card">

      <div class="card-title">
        <h1>Sign Up</h1>
      </div>

      <div class="content">
        <form method="POST" action="#">

          <input id="email" type="email" name="email" title="email" placeholder="Email" required autofocus>
          <input id="password" type="password" name="password" title="password" placeholder="Password" required>

          <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>