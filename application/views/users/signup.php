<div id="signup">
  <?php 
    if(isset($error)) echo '<p>' . $error . '</p>';
    echo validation_errors();
    echo form_open('user/signup'); 
  ?>
  <div>
    <h6>Signup</h6>
    <div>
      <input type="text" 
              name="email" 
              placeholder="Email*" 
              value="<?php echo set_value('email'); ?>" />
    </div>
    <div>
      <input type="password" 
              name="password" 
              placeholder="Desired Password*" 
              value="<?php echo set_value('password'); ?>" />
    </div>
      <div class="large-12 medium-12 small-12 columns">
        <button title="Login">Create Account</button>
      </div>
    </div>
  </form>
</div>