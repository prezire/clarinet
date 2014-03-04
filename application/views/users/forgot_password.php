<div id="forgotPassword">
  <h6>Forgot Password</h6>
  <div class="row">
    <?php 
      echo validation_errors();
      echo form_open('user/forgotPassword');
    ?>
      <input type="text" placeholder="Email*" name="email" />
      <div class="large-12 medium-12 small-12 columns">
        <button>Send</button>
      </div>
    </form>
  </div>
</div>