<div id="forgotPwd">
  <h4>Forgot Password</h4>
  <div class="row">
    <?php 
      echo validation_errors();
      echo form_open('user/forgotPassword');
    ?>
      <input type="text" placeholder="Email*" name="password" />
      <div class="large-3 medium-3 small-12 columns">
        <button>Confirm</button>
      </div>
    </form>
  </div>
</div>