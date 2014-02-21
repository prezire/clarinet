<div id="signup" class="row">
  <div class="logo">
    <a href="<?php echo site_url('home'); ?>" title="Clarinet">
      <img src="<?php echo base_url('public/images/logo.png'); ?>" />
    </a>
  </div>
  <?php 
    if(isset($error)) echo '<p>' . $error . '</p>';
    echo validation_errors();
    echo form_open('user/signup'); 
  ?>
  <div>
    <div>
      <input type="text" 
              name="email" 
              placeholder="Email*" 
              value="<?php echo set_value('email'); ?>" />
    </div>
    <div>
      <input type="password" 
              name="password" 
              placeholder="Password*" 
              value="<?php echo set_value('password'); ?>" />
    </div>
      <div class="large-12 medium-12 small-12 columns">
        <button title="Login">Create Account</button>
      </div>
    </div>
  </form>
</div>