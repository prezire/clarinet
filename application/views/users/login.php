<div id="login" class="row">
  <div class="bg"></div>
  <div class="content">
  <div class="logo">
    <a href="<?php echo site_url('home'); ?>" title="Clarinet">
      <div>
        <img src="<?php echo base_url('public/images/logo_cube.png'); ?>" />
      </div>
      <div>
        <img src="<?php echo base_url('public/images/logo.png'); ?>" />
      </div>
    </a>
  </div>
  <?php 
    if(isset($error)) echo '<p>' . $error . '</p>';
    echo validation_errors();
    echo form_open('user/login'); 
  ?>
  <div>
    <div>
      <input type="text" 
              name="email"
              placeholder="Email*" 
              value="<?php echo set_value('email', 'prezire@gmail.com'); ?>" />
    </div>
    <div>
      <input type="password" 
              name="password" 
              placeholder="Password*" 
              value="<?php echo set_value('password', '1'); ?>" />
    </div>
      <div class="large-12 medium-12 small-12 columns">
        <button title="Login">Go</button>
      </div>
    </div>
  </form>
  
  <a href="<?php echo site_url('user/signup'); ?>">
    Join Us
  </a>
  |
  <a href="<?php echo site_url('user/forgotPassword'); ?>">
    Forgot Password
  </a>
</div>